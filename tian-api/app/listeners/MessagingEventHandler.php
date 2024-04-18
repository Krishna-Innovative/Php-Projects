<?php

use IceAngel\Traits\NotificationHelpersTrait;

class MessagingEventHandler
{

    use NotificationHelpersTrait;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(['contact.requested', 'contact.resend'], 'MessagingEventHandler@onContactRequested');

        $events->listen('contact.cancelled', 'MessagingEventHandler@onContactCanceled');

        $events->listen('contact.accepted', 'MessagingEventHandler@onContactAccepted');

        $events->listen('contact.deleted', 'MessagingEventHandler@onContactDeleted');

        $events->listen('contact.declined', 'MessagingEventHandler@onContactDeclined');

        $events->listen(['guardian.requested', 'guardian.resend'], 'MessagingEventHandler@onGuardianRequested');

        $events->listen('guardian.cancelled', 'MessagingEventHandler@onGuardianCanceled');

        $events->listen('guardian.accepted', 'MessagingEventHandler@onGuardianAccepted');

        $events->listen('guardian.declined', 'MessagingEventHandler@onGuardianDeclined');

        $events->listen('guardian.deleted', 'MessagingEventHandler@onGuardianDeleted');

        $events->listen('friend.contact.deleted', 'MessagingEventHandler@onFriendContactDeleted');

        $events->listen('friend.guardian.deleted', 'MessagingEventHandler@onFriendGuardianDeleted');

        $events->listen('member.deleted', 'MessagingEventHandler@onMemberDeleted');

        $events->listen('account.deleted', 'MessagingEventHandler@onAccountDeleted');

        $events->listen('account.securityQuestionsUpdated', 'MessagingEventHandler@onSecurityQuestionsUpdated');

        $events->listen('member.share.view-profile', 'MessagingEventHandler@onMemberSharedProfileViewed');

        $events->listen('members.updated.scheduled-notification', 'MessagingEventHandler@onMembersUpdatedScheduledNotification');

        $events->listen('accounts.login-reminder.scheduled-notification', 'MessagingEventHandler@onAccountsLoginReminderScheduledNotification');

        $events->listen('accounts.nomination-reminder.scheduled-notification', 'MessagingEventHandler@onAccountsNominationReminderScheduledNotification');
        
        $events->listen('device.sync.requested', 'MessagingEventHandler@onDeviceSyncRequested');
        
        $events->listen('device.sync.accepted', 'MessagingEventHandler@onDeviceSyncAccepted');
        
        $events->listen('device.sync.declined', 'MessagingEventHandler@onDeviceSyncDeclined');

        $events->listen('device.sync.deleted', 'MessagingEventHandler@onDeviceSyncDeleted');

    }

    /**
     * Handle ECP nomination events.
     *
     * @param PendingRequest $request
     */
    public function onContactRequested($request)
    {
        $account = Sentry::getUser();
        $member = Member::find($request->requester_id);

        $toContactData = [
            'contact' => $request->email,
            'learnMore' => web_app_url('learn-more', $account->language),
            'login' => web_app_url('login', $account->language, ['query' => "?nomination={$request->token}&nominee={$request->email}"]),
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $request->email,
            'account' => $account->fullName(),
            'member' => $member->fullName(),
        ];

        // Only Account Holder
        if ($this->isAccountNominatedAsEcp($account, $request->requested_id)) {
            $this->sendInAppMessage('contact.request.to_self', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(), 'request' => $request->id,]);
        } else {

            if ($this->isRequestingRegisteredAccount($request)) {
                $contact = Account::find($request->requested_id);

                $toContactData['learnMore'] = web_app_url('learn-more', $contact->language);
                $toContactData['login'] = web_app_url('login', $contact->language, ['query' => "?nomination={$request->token}&nominee={$request->email}"]);
                $toContactData['contact'] = $contact->fullName();
                $toAccountData['contact'] = $contact->fullName();

                if ($contact->canSendNotificationEmail('invitation')) {
                    $this->notifyViaEmail($contact->email, 'contact-request', 'contact-request', $toContactData, $contact->language);
                }

                $this->sendInAppMessage('contact.request.to_contact', $contact->id, ['placeholders' => $toContactData, 'payload' => $request->toArray(), 'request' => $request->id,]);
                // $this->sendPushNotification($contact, 'contact.request.contact', $toContactData);
            } else {
                $this->notifyViaEmail($request->email, 'contact-request', 'contact-request', $toContactData, $account->language);
            }

            // Account Holder
            $this->sendInAppMessage('contact.request.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(), 'request' => $request->id,]);
            // $this->notifyViaEmail($account->email, 'contact-request-confirmation', 'contact-request', $toAccountData, $account->language);
            // $this->sendPushNotification($account, 'contact.request.account', $toAccountData);
        }
    }

    /**
     * Handle ECP nomination cancellation events.
     *
     * @param PendingRequest $request
     */
    public function onContactCanceled($request)
    {
        $account = Sentry::getUser();
        $member = Member::find($request->requester_id);

        $toContactData = [
            'contact' => $request->email,
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $request->email,
            'account' => $account->fullName(),
            'member' => $member->fullName(),
        ];

        if ($this->isRequestingRegisteredAccount($request)) {
            $contact = Account::find($request->requested_id);

            $toContactData['contact'] = $contact->fullName();
            $toAccountData['contact'] = $contact->fullName();

            if ($contact->canSendNotificationEmail('deletion')) {
                $this->notifyViaEmail($contact->email, 'contact-cancel', 'contact-request', $toContactData, $contact->language);
            }
            $this->sendInAppMessage('contact.cancel.to_contact', $contact->id, ['placeholders' => $toContactData, 'payload' => $request->toArray()]);
            // $this->sendPushNotification($contact, 'contact.cancel.contact', $toContactData);
        } else {
            $this->notifyViaEmail($request->email, 'contact-cancel', 'contact-request', $toContactData, $account->language);
        }

        // Account Holder
        $this->sendInAppMessage('contact.cancel.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray()]);
        $this->notifyViaEmail($account->email, 'contact-cancel-confirmation', 'contact-request', $toAccountData, $account->language);
        // $this->sendPushNotification($account, 'contact.cancel.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle ECP nomination acceptance events.
     *
     * @param PendingRequest $request
     */
    public function onContactAccepted($request)
    {
        $contact = Sentry::getUser();
        $member = Member::find($request->requester_id);
        $account = $member->account;

        // To Contact
        $toContactData = [
            'contact' => $contact->fullName(),
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $contact->fullName(),
            'account' => $account->fullName(),
            'member' => $member->fullName(),
        ];

        // To ECP
        if ($contact->canSendNotificationEmail('invitation')) {
            $this->notifyViaEmail($contact->email, 'contact-accept', 'contact-request', $toContactData, $contact->language);
        }
        $this->sendInAppMessage('contact.accept.to_contact', $contact->id, ['placeholders' => $toContactData,]);
        // $this->sendPushNotification($contact, 'contact.accept.contact', $toContactData);

        // Account Holder
        $this->notifyViaEmail($account->email, 'contact-accept-confirmation', 'contact-request', $toAccountData, $account->language);
        $this->sendInAppMessage('contact.accept.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'contact.accept.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle ECP nomination decline events.
     *
     * @param PendingRequest $request
     */
    public function onContactDeclined($request)
    {
        $contact = Sentry::getUser();
        $member = Member::find($request->requester_id);
        $account = $member->account;

        // To Contact
        $toContactData = [
            'contact' => $contact->fullName(),
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $contact->fullName(),
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'reason' => $request->reason,
            'login' => web_app_url('login', $account->language, ['query' => '']),
        ];

        // To ECP
        if ($contact->canSendNotificationEmail('decline')) {
            $this->notifyViaEmail($contact->email, 'contact-decline', 'contact-request', $toContactData, $contact->language);
        }
        $this->sendInAppMessage('contact.decline.to_contact', $contact->id, ['placeholders' => $toContactData,]);
        // $this->sendPushNotification($contact, 'contact.decline.contact', $toContactData);

        // Account Holder
        if ($account->canSendNotificationEmail('decline')) {
            $this->notifyViaEmail($account->email, 'contact-decline-confirmation', 'contact-request', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('contact.decline.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'contact.decline.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle ECP nomination deletion events.
     *
     * @param Member $member
     * @param Account $contact
     */
    public function onContactDeleted($member, $contact)
    {
        $account = Sentry::getUser();

        $toContactData = [
            'contact' => $contact->fullName(),
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $contact->fullName(),
            'account' => $account->fullName(),
            'member' => $member->fullName(),
        ];

        // To ECP
        if ($contact->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($contact->email, 'contact-delete', 'contact-request', $toContactData, $contact->language);
        }
        $this->sendInAppMessage('contact.delete.to_contact', $contact->id, ['placeholders' => $toContactData,]);
        // $this->sendPushNotification($contact, 'contact.delete.contact', $toContactData);

        // Account Holder
        if (!$this->isAccountNominatedAsEcp($account, $contact->id)) {
            if ($account->canSendNotificationEmail('deletion')) {
                $this->notifyViaEmail($account->email, 'contact-delete-confirmation', 'contact-request', $toAccountData, $account->language);
            }
            $this->sendInAppMessage('contact.delete.to_account', $account->id, ['placeholders' => $toAccountData,]);
            // $this->sendPushNotification($account, 'contact.delete.account', $toAccountData);
        }
    }

    /**
     * Handle Guardian nomination events.
     *
     * @param PendingRequest $request
     */
    public function onGuardianRequested($request)
    {
        $account = Sentry::getUser();

        $toGuardianData = [
            'guardian' => $request->email,
            'learnMore' => web_app_url('learn-more', $account->language),
            'login' => web_app_url('login', $account->language, ['query' => "?nomination={$request->token}&nominee={$request->email}"]),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $request->email,
            'account' => $account->fullName(),
        ];

        if ($this->isRequestingRegisteredAccount($request)) {
            $guardian = Account::find($request->requested_id);

            $toGuardianData['learnMore'] = web_app_url('learn-more', $guardian->language);
            $toGuardianData['login'] = web_app_url('login', $guardian->language, ['query' => "?nomination={$request->token}&nominee={$request->email}"]);
            $toGuardianData['guardian'] = $guardian->fullName();
            $toAccountData['guardian'] = $guardian->fullName();

            if ($guardian->canSendNotificationEmail('invitation')) {
                $this->notifyViaEmail($guardian->email, 'guardian-request', 'guardian-request', $toGuardianData, $guardian->language);
            }

            $this->sendInAppMessage('guardian.request.to_guardian', $guardian->id, ['placeholders' => $toGuardianData, 'payload' => $request->toArray(), 'request' => $request->id,]);
            // $this->sendPushNotification($guardian, 'guardian.request.guardian', $toGuardianData);
        } else {
            $this->notifyViaEmail($request->email, 'guardian-request', 'guardian-request', $toGuardianData, $account->language);
        }

        // Account Holder
        $this->sendInAppMessage('guardian.request.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(), 'request' => $request->id,]);
        $this->notifyViaEmail($account->email, 'guardian-request-confirmation', 'guardian-request', $toAccountData, $account->language);
        // $this->sendPushNotification($account, 'guardian.request.account', $toAccountData);
    }

    /**
     * Handle Guardian nomination cancellation events.
     *
     * @param PendingRequest $request
     */
    public function onGuardianCanceled($request)
    {
        $account = Sentry::getUser();

        $toGuardianData = [
            'guardian' => $request->email,
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $request->email,
            'account' => $account->fullName(),
        ];

        if ($this->isRequestingRegisteredAccount($request)) {
            $guardian = Account::find($request->requested_id);

            $toGuardianData['guardian'] = $guardian->fullName();
            $toAccountData['guardian'] = $guardian->fullName();

            if ($guardian->canSendNotificationEmail('deletion')) {
                $this->notifyViaEmail($guardian->email, 'guardian-cancel', 'guardian-request', $toGuardianData, $guardian->language);
            }

            $this->sendInAppMessage('guardian.cancel.to_guardian', $guardian->id, ['placeholders' => $toGuardianData, 'payload' => $request->toArray(),]);
            // $this->sendPushNotification($guardian, 'guardian.cancel.guardian', $toGuardianData);
        } else {
            $this->notifyViaEmail($request->email, 'emails.guardians.cancel', 'guardian-request', $toGuardianData, $account->language);
        }

        // Account Holder
        $this->sendInAppMessage('guardian.cancel.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(),]);
        $this->notifyViaEmail($account->email, 'guardian-cancel-confirmation', 'guardian-request', $toAccountData, $account->language);
        // $this->sendPushNotification($account, 'guardian.cancel.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle Guardian nomination acceptance events.
     *
     * @param PendingRequest $request
     */
    public function onGuardianAccepted($request)
    {
        $guardian = Sentry::getUser();
        $account = Account::find($request->requester_id);

        $toGuardianData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
        ];

        // Guardian
        if ($guardian->canSendNotificationEmail('invitation')) {
            $this->notifyViaEmail($guardian->email, 'guardian-accept', 'guardian-request', $toGuardianData, $guardian->language);
        }

        $this->sendInAppMessage('guardian.accept.to_guardian', $guardian->id, ['placeholders' => $toGuardianData, 'payload' => $request->toArray(),]);
        // $this->sendPushNotification($guardian, 'guardian.accept.guardian', $toGuardianData);

        // Account Holder
        $this->sendInAppMessage('guardian.accept.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(),]);
        $this->notifyViaEmail($account->email, 'guardian-accept-confirmation', 'guardian-request', $toAccountData, $account->language);
        // $this->sendPushNotification($account, 'guardian.accept.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle Guardian nomination decline events.
     *
     * @param PendingRequest $request
     */
    public function onGuardianDeclined($request)
    {
        $guardian = Sentry::getUser();
        $account = Account::find($request->requester_id);

        $toGuardianData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
            'reason' => $request->reason,
            'login' => web_app_url('login', $account->language, ['query' => '']),
        ];

        // Guardian
        if ($guardian->canSendNotificationEmail('decline')) {
            $this->notifyViaEmail($guardian->email, 'guardian-decline', 'guardian-request', $toGuardianData, $guardian->language);
        }
        $this->sendInAppMessage('guardian.decline.to_guardian', $guardian->id, ['placeholders' => $toGuardianData, 'payload' => $request->toArray(),]);
        // $this->sendPushNotification($guardian, 'guardian.decline.guardian', $toGuardianData);

        // Account Holder
        if ($account->canSendNotificationEmail('decline')) {
            $this->notifyViaEmail($account->email, 'guardian-decline-confirmation', 'guardian-request', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('guardian.decline.to_account', $account->id, ['placeholders' => $toAccountData, 'payload' => $request->toArray(),]);
        // $this->sendPushNotification($account, 'guardian.decline.account', $toAccountData);

        $this->cleanUpOldNominationMessages($request);
    }

    /**
     * Handle Guardian deletion events.
     *
     * @param Account $account
     * @param Account $guardian
     */
    public function onGuardianDeleted($account, $guardian)
    {
        $toGuardianData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
            'login' => web_app_url('login', $account->language, ['query' => '']),
        ];

        // Guardian
        if ($guardian->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($guardian->email, 'guardian-delete', 'guardian-request', $toGuardianData, $guardian->language);
        }
        $this->sendInAppMessage('guardian.delete.to_guardian', $guardian->id, ['placeholders' => $toGuardianData,]);
        // $this->sendPushNotification($guardian, 'guardian.delete.guardian', $toGuardianData);

        // Account Holder
        if ($account->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($account->email, 'guardian-delete-confirmation', 'guardian-request', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('guardian.delete.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'guardian.delete.account', $toAccountData);
    }

    /**
     * Handle ECP removes friend in need events
     *
     * @param Account $contact
     * @param int $memberId
     */
    public function onFriendContactDeleted($contact, $memberId)
    {
        $member = Member::find($memberId);
        $account = $member->account;

        $toContactData = [
            'contact' => $contact->fullName(),
            'member' => $member->fullName(),
        ];

        $toAccountData = [
            'contact' => $contact->fullName(),
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'countContacts' => $member->contacts()->count(),
            'login' => web_app_url('login', $account->language, ['query' => '']),
        ];

        // To ECP
        if ($contact->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($contact->email, 'friend-contact-delete', 'friend-contact-delete', $toContactData, $contact->language);
        }
        $this->sendInAppMessage('friends.delete_contact.to_contact', $contact->id, ['placeholders' => $toContactData,]);
        // $this->sendPushNotification($contact, 'friends.delete_contact.contact', $toContactData);

        // Account Holder
        if ($account->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($account->email, 'friend-contact-delete-confirmation', 'friend-contact-delete', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('friends.delete_contact.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'friends.delete_contact.account', $toAccountData);

    }

    /**
     * Handle Guardian removes friend in need events
     *
     * @param Account $guardian
     * @param int $accountId
     */
    public function onFriendGuardianDeleted($guardian, $accountId)
    {
        /** @var Account $account */
        $account = Account::find($accountId);

        $toGuardianData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'guardian' => $guardian->fullName(),
            'account' => $account->fullName(),
            'countGuardians' => $account->guardians()->count(),
            'login' => web_app_url('login', $account->language, ['query' => '']),
        ];

        // To ECP
        if ($guardian->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($guardian->email, 'friend-guardian-delete', 'friend-guardian-delete', $toGuardianData, $guardian->language);
        }
        $this->sendInAppMessage('friends.delete_guardian.to_guardian', $guardian->id, ['placeholders' => $toGuardianData,]);
        // $this->sendPushNotification($guardian, 'friends.delete_guardian.guardian', $toGuardianData);

        // Account Holder
        if ($account->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($account->email, 'friend-guardian-delete-confirmation', 'friend-guardian-delete', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('friends.delete_guardian.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'friends.delete_guardian.account', $toAccountData);
    }

    /**
     * Handle delete a Member events.
     *
     * @param Member $member
     * @param \Illuminate\Database\Eloquent\Collection $contacts
     */
    public function onMemberDeleted($member, $contacts)
    {
        $account = Sentry::getUser();

        $toContactData = [
            'member' => $member->fullName(),
            'account' => $account->fullName(),
        ];

        $toAccountData = [
            'account' => $account->fullName(),
            'member' => $member->fullName() . ' [' . $member->ice_id . ']',
        ];

        $contacts->each(function ($contact) use ($account, $toContactData) {
            if (!$this->isAccountNominatedAsEcp($account, $contact['id'])) {
                if (!is_null($contact['id'])) {
                    $contact = Account::find($contact['id']);
                    $toContactData['contact'] = $contact->fullName();

                    if ($contact->canSendNotificationEmail('deletion')) {
                        $this->notifyViaEmail($contact->email, 'member-delete', 'member-delete', $toContactData, $contact->language);
                    }
                    $this->sendInAppMessage('member.delete.to_contact', $contact->id, ['placeholders' => $toContactData,]);
                    // $this->sendPushNotification($contact, 'member.delete.contact', $toContactData);
                } else {
                    // No Need to send email to non-registered contact
                    // $this->notifyViaEmail($contact['email'], 'member-delete', 'member-delete', $toContactData. $account->language);
                }
            }
        });

        // Account Holder
        if ($account->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($account->email, 'member-delete-confirmation', 'member-delete', $toAccountData, $account->language);
        }
        $this->sendInAppMessage('member.delete.to_account', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'member.delete.account', $toAccountData);
    }

    /**
     * Handle delete Account Holder events.
     *
     * @param Account $account
     */
    public function onAccountDeleted($account)
    {
        if ($account->canSendNotificationEmail('deletion')) {
            $this->notifyViaEmail($account->email, 'account-delete-confirmation', 'account-delete', ['account' => $account->fullName()], $account->language);
        }
    }

    /**
     * Handle delete Account Security Questions Updated Event.
     *
     * @param Account $account
     */
    public function onSecurityQuestionsUpdated($account)
    {

        $toAccountData = [
            'account' => $account->fullName(),
            'account-settings' => web_app_url('account-settings', $account->language, ['query' => '']),
        ];

        if ($account->canSendNotificationEmail('questions-update')) {
            $this->notifyViaEmail($account->email, 'account-security-questions-updated', 'account-security-questions-update', $toAccountData, $account->language);
        }

        $this->sendInAppMessage('account.questions-updated', $account->id);

    }

    /**
     * Handle View member profile event
     *
     * @param Member $member
     */
    public function onMemberSharedProfileViewed($member)
    {
        //mute all shared profile viewed notifs
        return;

        $account = $member->account;

        $toAccountData = [
            'account' => $account->fullName(),
            'contact' => ($account->language == 'zh') ? '第三方' : 'third party',
            'member' => $member->fullName(),
        ];

        if (!is_null($contact = $this->getUserIfExists())) {
            $toAccountData['contact'] = $contact->fullName();
        }

        // if ($account->canSendNotificationEmail('view')) {
        //     $this->notifyViaEmail($account->email, 'member-profile-viewed-confirmation', 'emergency-alert', $toAccountData, $account->language);
        // }
        $this->sendInAppMessage('member.profile.viewed', $account->id, ['placeholders' => $toAccountData,]);
        // $this->sendPushNotification($account, 'member.profile.viewed', $toAccountData);
    }

    /**
     * Send notifications to Accounts to inform them about their updated member profiles
     *
     * @param \Illuminate\Support\Collection $members
     */
    public function onMembersUpdatedScheduledNotification($members)
    {
        $members->groupBy('account_id')->map(function ($members, $accountId) {

            $account = Account::find($accountId);

            $toAccountData = [
                'account' => $account->fullName(),
                'members' => '',
                'login' => web_app_url('login', $account->language, ['query' => '']),
            ];

            foreach ($members as $member) {
                $toAccountData['members'] .= sprintf('- %s [%s]<br>', $member->fullName(), $member->ice_id);
            }

            if ($account->canSendNotificationEmail('editing')) {
                $this->notifyViaEmail($account->email, 'account-members-updated', 'members-updated', $toAccountData, $account->language);
            }

            $toAccountData['members'] = '';
            foreach ($members as $member) {
                $toAccountData['members'] .= sprintf('%s [%s], ', $member->fullName(), $member->ice_id);
            }

            $this->sendInAppMessage('account.members-updated', $account->id, ['placeholders' => $toAccountData,]);
        });
    }

    /**
     * Remind Account holders to login to update their information
     *
     * @param \Illuminate\Support\Collection $accounts
     */
    public function onAccountsLoginReminderScheduledNotification($accounts)
    {
        $accounts->each(function ($account) {
            $toAccountData = [
                'account' => $account->fullName(),
                'members' => '',
                'login' => web_app_url('login', $account->language, ['query' => '']),
            ];

            foreach ($account->members as $member) {
                $toAccountData['members'] .= sprintf('- %s [%s]<br>', $member->fullName(), $member->ice_id);
            }

            $this->notifyViaEmail($account->email, 'account-login-remind', 'login-remind', $toAccountData, $account->language);
            // $this->sendInAppMessage('account.login-remind', $account->id, ['placeholders' => $toAccountData,]);

            // Reset the timer
            $account->touch();
        });
    }

    /**
     * Remind ECPs and Guardians to respond to Accounts nominations
     *
     * @param \Illuminate\Support\Collection $nominations
     */
    public function onAccountsNominationReminderScheduledNotification($nominations)
    {
        $nominations->each(function ($nomination) {

            if (($nomination->type == 'contact') && !is_null($member = Member::find($nomination->requester_id))) {

                $account = $member->account;

                $toContactData = [
                    'contact' => $nomination->email,
                    'learnMore' => web_app_url('learn-more', $account->language),
                    'login' => web_app_url('login', $account->language, ['query' => "?nomination={$nomination->token}&nominee={$nomination->email}"]),
                    'member' => $member->fullName(),
                ];

                $toAccountData = [
                    'contact' => $nomination->email,
                    'account' => $account->fullName(),
                    'member' => $member->fullName(),
                ];

                if ($this->isRequestingRegisteredAccount($nomination)) {
                    $contact = Account::find($nomination->requested_id);

                    $toContactData['learnMore'] = web_app_url('learn-more', $contact->language);
                    $toContactData['login'] = web_app_url('login', $contact->language, ['query' => "?nomination={$nomination->token}&nominee={$nomination->email}"]);
                    $toContactData['contact'] = $contact->fullName();
                    $toAccountData['contact'] = $contact->fullName();

                    if ($contact->canSendNotificationEmail('invitation')) {
                        $this->notifyViaEmail($contact->email, 'contact-request', 'contact-request', $toContactData, $contact->language);
                    }

                } else {
                    $this->notifyViaEmail($nomination->email, 'contact-request', 'contact-request', $toContactData, $account->language);
                }

                // Account Holder
                $this->notifyViaEmail($account->email, 'contact-request-confirmation', 'contact-request', $toAccountData, $account->language);

            } elseif (($nomination->type == 'guardian') && !is_null($account = Account::find($nomination->requester_id))) {

                $toGuardianData = [
                    'guardian' => $nomination->email,
                    'learnMore' => web_app_url('learn-more', $account->language),
                    'login' => web_app_url('login', $account->language, ['query' => "?nomination={$nomination->token}&nominee={$nomination->email}"]),
                    'account' => $account->fullName(),
                ];

                $toAccountData = [
                    'guardian' => $nomination->email,
                    'account' => $account->fullName(),
                ];

                if ($this->isRequestingRegisteredAccount($nomination)) {
                    $guardian = Account::find($nomination->requested_id);

                    $toGuardianData['learnMore'] = web_app_url('learn-more', $guardian->language);
                    $toGuardianData['login'] = web_app_url('login', $guardian->language, ['query' => "?nomination={$nomination->token}&nominee={$nomination->email}"]);
                    $toGuardianData['guardian'] = $guardian->fullName();
                    $toAccountData['guardian'] = $guardian->fullName();

                    if ($guardian->canSendNotificationEmail('invitation')) {
                        $this->notifyViaEmail($guardian->email, 'guardian-request', 'guardian-request', $toGuardianData, $guardian->language);
                    }

                } else {
                    $this->notifyViaEmail($nomination->email, 'guardian-request', 'guardian-request', $toGuardianData, $account->language);
                }

                // Account Holder
                $this->notifyViaEmail($account->email, 'guardian-request-confirmation', 'guardian-request', $toAccountData, $account->language);
            }

            // Reset a timer
            $nomination->touch();
        });
    }
    
    /**
     * Notify Account about new sync device requests
     *
     * @param Member $member
     * @param Device $device
     */
    public function onDeviceSyncRequested($member, $device)
    {
        $account = $member->account;
        
        $toAccountData = [
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'member_id' => $member->id,
            'phone' => trim($device->phone_number),
            'login' => web_app_url('login', $account->language, ['query' => '']),
            'uuid' => $device->uuid,
            'device_id' => $device->id,
        ];

        if ($account->canSendNotificationEmail('invitation')) {
            $this->notifyViaEmail($account->email, 'member-sync-device-request', 'sync-device', $toAccountData, $account->language);
        }

        $this->sendInAppMessage('sync.request', $account->id, ['placeholders' => $toAccountData, 'payload' => $toAccountData]);                
    }

    /**
     * Notify Account when he/she accepts sync device requests
     *
     * @param Member $member
     * @param Device $device
     */
    public function onDeviceSyncAccepted($member, $device)
    {
        $account = $member->isAccount() ? $member :$member->account;
        
        $toAccountData = [
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'member_id' => $member->id,
            'phone' => trim($device->phone_number),
            'login' => web_app_url('login', $account->language, ['query' => '']),
            'uuid' => $device->uuid,
        ];

        // $this->sendPushNotification($member, 'messages.sync.accept', $account->language);
        $this->sendInAppMessage('sync.accept', $account->id, ['placeholders' => $toAccountData, 'payload' => $toAccountData]);

        $device->deleteSyncRequest();
    }

    /**
     * Notify Account when he/she accepts sync device requests
     *
     * @param Member $member
     * @param Device $device
     */
    public function onDeviceSyncDeleted($member, $device)
    {
        $account = $member->isAccount() ? $member :$member->account;

        $toAccountData = [
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'member_id' => $member->id,
            'phone' => trim($device->phone_number),
            'login' => web_app_url('login', $account->language, ['query' => '']),
            'uuid' => $device->uuid,
        ];

        $this->sendInAppMessage('sync.decline', $account->id, ['placeholders' => $toAccountData, 'payload' => $toAccountData]);
    }

    /**
     * Notify Account when he/she rejects sync device requests
     *
     * @param Member $member
     * @param Device $device
     */
    public function onDeviceSyncDeclined($member, $device)
    {
        $account = $member->account;
        
        $toAccountData = [
            'account' => $account->fullName(),
            'member' => $member->fullName(),
            'member_id' => $member->id,
            'phone' => trim($device->phone_number),
            'login' => web_app_url('login', $account->language, ['query' => '']),
            'uuid' => $device->uuid,
        ];

        // $this->sendPushNotification($member, 'messages.sync.decline', $account->language);
        $this->sendInAppMessage('sync.decline', $account->id, ['placeholders' => $toAccountData, 'payload' => $toAccountData]);

        $device->deleteSyncRequest();                
    }
    
    /**
     * Check if the Account holder is the nominated ECP
     *
     * @param Account $account
     * @param int $nominatedEcpId
     *
     * @return bool
     */
    protected function isAccountNominatedAsEcp($account, $nominatedEcpId)
    {
        return $account->id === $nominatedEcpId;
    }

    /**
     * Check if the requested ECP is already an account
     *
     * @param PendingRequest $request
     *
     * @return bool
     */
    protected function isRequestingRegisteredAccount($request)
    {
        return !is_null($request->requested_id);
    }

    /**
     * Remove old nomination's messages
     *
     * @param PendingRequest $request
     *
     * @return mixed
     */
    protected function cleanUpOldNominationMessages($request)
    {
        return $request->messages()->delete();
    }

    /**
     * Format a full name
     *
     * @param  string $firstName
     * @param  string $lastName
     * @param  string $middleName
     *
     * @return string
     */
    protected function fullName($firstName, $lastName, $middleName = null)
    {
        if ($middleName) {
            return sprintf('%s %s %s', $firstName, $middleName, $lastName);
        }

        return sprintf('%s %s', $firstName, $lastName);
    }

    /**
     * Get the logged in user in case of routes which do not require authentication
     *
     * @return null|Account
     */
    protected function getUserIfExists()
    {
        try {
            /** @var JwtFilter $filter */
            $filter = \App::make('JwtFilter');
            $accessToken = $filter->determineAccessToken();

            $decryptedToken = IceAngel\Auth\JWT::decrypt($accessToken);

            // Find the user using the user id
            $user = \Sentry::findUserById($decryptedToken->uid);

            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }
}

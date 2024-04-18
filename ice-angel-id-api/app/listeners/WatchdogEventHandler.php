<?php

use Illuminate\Support\Collection;

class WatchdogEventHandler {

    /**
     * @var Collection
     */
    private $events;

    /**
     * @var \Illuminate\Translation\Translator
     */
    private $translator;

    /**
     * @var Collection
     */
    private static $logged;

    /**
     * @param \Illuminate\Translation\Translator $translator
     */
    function __construct(Illuminate\Translation\Translator $translator)
    {
        $this->translator = $translator;

        self::$logged = self::$logged ?: new Collection();

        $this->events = new Collection([
            'account.login',
            'account.activated',
            'account.password-updated',
            'account.password.reset',
            'account.email-updated',
            'member.share.download-member-id',
            'member.share.download-member-profile',
            // 'member.share.email',
            'device.sync.accepted',
            'device.sync.declined',
            'device.sync.deleted',
        ]);

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('alert.triggered', 'WatchdogEventHandler@onAlertTriggered');

        $events->listen('contact.requested', 'WatchdogEventHandler@onContactRequested');

        $events->listen('contact.accepted', 'WatchdogEventHandler@onContactAccepted');

        $events->listen('contact.declined', 'WatchdogEventHandler@onContactDeclined');

        $events->listen('contact.cancelled', 'WatchdogEventHandler@onContactCanceled');

        $events->listen('contact.deleted', 'WatchdogEventHandler@onContactDeleted');

        $events->listen('guardian.requested', 'WatchdogEventHandler@onGuardianRequested');

        $events->listen('guardian.accepted', 'WatchdogEventHandler@onGuardianAccepted');

        $events->listen('guardian.declined', 'WatchdogEventHandler@onGuardianDeclined');

        $events->listen('guardian.cancelled', 'WatchdogEventHandler@onGuardianCancelled');

        $events->listen('guardian.deleted', 'WatchdogEventHandler@onGuardianDeleted');

        // $events->listen('device.synced', 'WatchdogEventHandler@onDeviceSynced');

        // $events->listen('device.unsynced', 'WatchdogEventHandler@onDeviceUnSynced');

        $events->listen('friend.guardian.deleted', 'WatchdogEventHandler@onFriendGuardianDeleted');

        $events->listen('friend.contact.deleted', 'WatchdogEventHandler@onFriendContactDeleted');

        $events->listen('eloquent.attribute.saved*', 'WatchdogEventHandler@onAttributeUpdated');

        $events->listen('member.share.view-profile', 'WatchdogEventHandler@onMemberSharedProfileAccessed');

        $events->listen('member.share.email', 'WatchdogEventHandler@onMemberProfileEmailed');

        $events->listen('*', function () use ($events) {
            if ($this->events->contains($events->firing())) {
                $this->handle($events->firing(), func_get_args());
            }
        });
    }

    /**
     * Handle alert trigger event.
     *
     * @param Alert $alert
     */
    public function onAlertTriggered(Alert $alert)
    {
        if ($alert->type == 'normal') {
            $this->record($alert->member, 'alert.normal', []);
        }
        else {
            $this->record($alert->member, 'alert.panic', []);
        }
    }

    /**
     * Handle ecp request event.
     *
     * @param $request
     */
    public function onContactRequested($request)
    {
        $member = Member::find($request->requester_id);
        $contact = Account::find($request->requested_id);

        $this->record($member, 'ecp.request.member', ['contact' => $contact ? $contact->fullName() : $request->email]);
        $this->record($contact, 'ecp.request.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle ecp accept request event
     *
     * @param $request
     */
    public function onContactAccepted($request)
    {
        $member = Member::find($request->requester_id);
        $contact = Account::find($request->requested_id);

        $this->record($member, 'ecp.accept.member', ['contact' => $contact ? $contact->fullName() : $request->email]);
        $this->record($contact, 'ecp.accept.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle ecp decline request event
     *
     * @param $request
     */
    public function onContactDeclined($request)
    {
        $member = Member::find($request->requester_id);
        $contact = Account::find($request->requested_id);

        $this->record($member, 'ecp.decline.member', ['contact' => $contact ? $contact->fullName() : $request->email]);
        $this->record($contact, 'ecp.decline.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle ecp cancel request event
     *
     * @param $request
     */
    public function onContactCanceled($request)
    {
        $member = Member::find($request->requester_id);
        $contact = Account::find($request->requested_id);

        $this->record($member, 'ecp.cancel.member', ['contact' => $contact ? $contact->fullName() : $request->email]);
        $this->record($contact, 'ecp.cancel.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle ecp delete request event
     *
     * @param Member $member
     * @param Account $contact
     */
    public function onContactDeleted($member, $contact)
    {
        $this->record($member, 'ecp.delete.member', ['contact' => $contact->fullName()]);
        $this->record($contact, 'ecp.delete.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle guardian request event
     *
     * @param $request
     */
    public function onGuardianRequested($request)
    {
        $account = Account::find($request->requester_id);
        $guardian = Account::find($request->requested_id);

        $this->record($account, 'guardian.request.account', ['guardian' => $guardian ? $guardian->fullName() : $request->email]);
        $this->record($guardian, 'guardian.request.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle guardian accept request event
     *
     * @param $request
     */
    public function onGuardianAccepted($request)
    {
        $account = Account::find($request->requester_id);
        $guardian = Account::find($request->requested_id);

        $this->record($account, 'guardian.accept.account', ['guardian' => $guardian ? $guardian->fullName() : $request->email]);
        $this->record($guardian, 'guardian.accept.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle guardian decline request event
     *
     * @param $request
     */
    public function onGuardianDeclined($request)
    {
        $account = Account::find($request->requester_id);
        $guardian = Account::find($request->requested_id);

        $this->record($account, 'guardian.decline.account', ['guardian' => $guardian ? $guardian->fullName() : $request->email]);
        $this->record($guardian, 'guardian.decline.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle guardian cancel request event
     *
     * @param $request
     */
    public function onGuardianCancelled($request)
    {
        $account = Account::find($request->requester_id);
        $guardian = Account::find($request->requested_id);

        $this->record($account, 'guardian.cancel.account', ['guardian' => $guardian ? $guardian->fullName() : $request->email]);
        $this->record($guardian, 'guardian.cancel.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle guardian delete request event
     *
     * @param Account $account
     * @param Account $guardian
     */
    public function onGuardianDeleted($account, $guardian)
    {
        $this->record($account, 'guardian.delete.account', ['guardian' => $guardian->fullName()]);
        $this->record($guardian, 'guardian.delete.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle friend guardian delete event
     *
     * @param $guardian
     * @param $accountId
     */
    public function onFriendGuardianDeleted($guardian, $accountId)
    {
        $account = Account::find($accountId);

        $this->record($account, 'friend.guardian.account', ['guardian' => $guardian->fullName()]);
        $this->record($guardian, 'friend.guardian.guardian', ['account' => $account->fullName()]);
    }

    /**
     * Handle friend contact delete event
     *
     * @param $contact
     * @param $memberId
     */
    public function onFriendContactDeleted($contact, $memberId)
    {
        $member = Member::find($memberId);

        $this->record($member, 'friend.contact.member', ['contact' => $contact->fullName()]);
        $this->record($contact, 'friend.contact.contact', ['member' => $member->fullName()]);
    }

    /**
     * Handle syncing new device
     *
     * @param $device
     */
    public function onDeviceSynced($device)
    {
        $this->record($device->member, 'device.synced', []);
    }

    /**
     * Handle syncing new device
     *
     * @param $device
     */
    public function onDeviceUnSynced($device)
    {
        $this->record($device->member, 'device.unsynced', []);
    }

    /**
     * Handle viewing member profile by an ECP
     *
     * @param $member
     *
     * @internal param $contact
     */
    public function onMemberSharedProfileAccessed($member)
    {
        if (!is_null($contact = $this->getUserIfExists())) {
            $this->record($member, 'member.share.view-profile.contact', ['contact' => $contact->fullName()]);
        }
        else {
            $this->record($member, 'member.share.view-profile.third-party', []);
        }
    }

    /**
     * Handle emailing member profile by an ECP
     *
     * @param $member
     */
    public function onMemberProfileEmailed($member)
    {
        $contact = Sentry::getUser();

        if ($contact->id == $member->account_id) {
            $this->record($member, 'member.share.email.account', []);
        } else {
            $this->record($member, 'member.share.email.contact', ['contact' => $contact->fullName()]);
        }
    }

    /**
     * Handle updating the attribute
     *
     * @param User $user
     * @param User $model
     * @param string $attribute
     */
    public function onAttributeUpdated($user, $model, $attribute)
    {
        if (($model instanceof \Account)
            || ($model instanceof \Member)
            || ($model instanceof \MemberPersonal)
        ) {
            if (($key = 'attributes.' . $attribute) && $this->translator->has($key)) {
                $this->record($user, 'member.attribute.updated', ['attribute' => $this->translator->trans($key)]);
            }
        }
        elseif (($model instanceof \AdditionalInformationBaseModel)
            && ($modelKey = get_class($model) . '-' . $model->id)
            && (!self::$logged->contains($modelKey))
        ) {
            if (($key = 'attributes.' . $model->getTable()) && $this->translator->has($key)) {
                $this->record($user, 'member.attribute.updated', ['attribute' => $this->translator->trans($key)]);

                self::$logged->push($modelKey);
            }
        }
    }

    /**
     * Create a history record
     *
     * @param User $user
     * @param string $messageKey
     * @param array $variables
     */
    private function record($user, $messageKey, array $variables = [])
    {
        if ($user) {
            $user->history()->create([
                'message_key' => 'watchdog.' . $messageKey,
                'variables' => base64_encode(serialize($variables)),
                'hostname' => Request::getClientIp(),
            ]);
        }
    }

    /**
     * Handle generic simple event
     *
     * @param string $event
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function handle($event, array $params)
    {
        $user = array_shift($params);

        $this->record($user, $event, []);
    }

    /**
     * Get the logged in user in case of routes which do not require authentication
     *
     * @return null|Account
     */
    private function getUserIfExists()
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
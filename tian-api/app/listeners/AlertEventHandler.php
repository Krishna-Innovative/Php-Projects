<?php

use IceAngel\Notifications\NotificationProcessor;

class AlertEventHandler {
    /**
     * @var NotificationProcessor
     */
    private $notificationProcessor;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('alert.triggered', 'AlertEventHandler@onAlertTriggered');
    }
    
    /**
     * Client ids to be notified.
     *
     * @var array
     */
    private $contactIds = [];

    /**
     * @param NotificationProcessor $notificationProcessor
     */
    function __construct(NotificationProcessor $notificationProcessor)
    {
        $this->notificationProcessor = $notificationProcessor;
    }

    /**
     * Handle alert trigger event.
     *
     * @param Alert $alert
     */
    public function onAlertTriggered($alert)
    {
        $users = $this->getUsersToBeNotified($alert);

        $this->shareMemberProfileWithContacts($users, $alert);

        $this->notificationProcessor->process($users, $alert);

        $this->pushToSocketServer($alert);
    }

    /**
     * Get list of users to be notified.
     *
     * @param $alert
     * @return array
     */
    protected function getUsersToBeNotified($alert)
    {
        $users = new \Illuminate\Support\Collection();

        $alert->member->contacts()->each(function ($contact) use ($users, $alert) {

            if (($contact['id'] !== $alert->account_id) && ($contact['status'] == 'accepted')) {

                $users->push($contact);

                $this->contactIds[] = $contact['id'];
            }

        });

        $users->push($alert->member->account->toArray());

        $this->contactIds[] = $alert->account_id;

        return $users->toArray();
    }

    /**
     * Create shared member profile depends on contact's permissions
     *
     * @param array $users
     * @param Alert $alert
     */
    protected function shareMemberProfileWithContacts($users, $alert)
    {
        // Get contacts from list of users
        $contacts = array_filter($users, function ($user) use ($alert) {
            return $alert->account_id !== $user['id'];
        });

        /** @var Member $member */
        $member = $alert->member;

        foreach ($contacts as $contact) {
            $permissions = $this->getContactPermission($member, $contact['id']);

            MemberSharedProfile::create([
                'member_id' => $member->id,
                'contact_id' => $contact['id'],
                'alert_id' => $alert->id,
                'profile' => $member->getAdditionalInformationFromPermissions($permissions),
            ]);
        }
    }

    /**
     * Notify connected client sockets.
     *
     * @param $alert
     */
    protected function pushToSocketServer($alert)
    {
        $member = $alert->member;
        $data = $alert->toArray();

        // Push to ECP
        foreach ($this->contactIds as $contactId) {
            if ($contactId !== $member->account_id) {
                $friends = array_merge($data, ['url' => $this->getSharedProfileUrl($alert, $contactId)]);

                \Socket::pushFromServer('alerts', ['friends' => [$friends],], $this->contactIds);
            }
        }

        // Push to Account holder
        $members = array_merge($data, ['url' => $this->getSharedProfileUrl($alert, $member->account_id)]);
        \Socket::pushFromServer('alerts', ['members' => [$members]], [$alert->account_id]);
    }

    /**
     * Get the link to the member's profile
     *
     * @param \Alert $alert
     * @param int $contactId
     * @return string
     */
    protected function getSharedProfileUrl($alert, $contactId)
    {
        $member = $alert->member;

        // Link to member's profile page
        if ($member->account_id == $contactId) {
            return web_app_url('member-profile', $member->account->language, ['memberId' => $member->id, 'query' => '']);
        }

        $sharedProfile = MemberSharedProfile::findByAlert($alert->id, $contactId);

        $contact = \Account::find($contactId);
        $expires = $sharedProfile->expires_at;
        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expires->toDateTimeString(),  $expires->timezoneName);
        $timestamp = $timestamp->setTimezone('UTC')->toISO8601String();

        return web_app_url('shared_profile', $contact->language, ['token' => $sharedProfile->token]) . "?expireDate={$timestamp}";
    }

    /**
     * Get Contact's permissions
     *
     * @param Member $member
     * @param int $contactId
     * @return array
     */
    private function getContactPermission($member, $contactId)
    {
        $permissions = MemberContactPermission::findByRelation($member->id, $contactId);

        if (is_null($permissions)) {
            // $permissions = MemberContactPermission::create([
            //     'member_id' => $member->id,
            //     'contact_id' => $contactId,
            //     'permissions' => $member->defaultPermissions(),
            // ]);

            return $member->defaultPermissions();
        }

        return $permissions->permissions;
    }
}
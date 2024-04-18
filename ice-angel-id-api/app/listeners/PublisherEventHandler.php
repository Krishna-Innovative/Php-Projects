<?php

class PublisherEventHandler {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('contact.requested', 'PublisherEventHandler@onContactRequested');

        $events->listen('contact.accepted', 'PublisherEventHandler@onContactAccepted');

        $events->listen('contact.declined', 'PublisherEventHandler@onContactDeclined');

        $events->listen('contact.canceled', 'PublisherEventHandler@onContactCanceled');

        $events->listen('contact.deleted', 'PublisherEventHandler@onContactDeleted');

        $events->listen('guardian.requested', 'PublisherEventHandler@onGuardianRequested');

        $events->listen('guardian.accepted', 'PublisherEventHandler@onGuardianAccepted');

        $events->listen('guardian.declined', 'PublisherEventHandler@onGuardianDeclined');

        $events->listen('guardian.canceled', 'PublisherEventHandler@onGuardianCanceled');

        $events->listen('guardian.deleted', 'PublisherEventHandler@onGuardianDeleted');

        $events->listen('friend.contact.deleted', 'PublisherEventHandler@onFriendContactDeleted');

        $events->listen('friend.guardian.deleted', 'PublisherEventHandler@onFriendGuardianDeleted');

        $events->listen(['account.updated', 'member.added', 'member.updated', 'member.deleted'], 'PublisherEventHandler@onAccountOrMemberUpdated');

        $events->listen(['device.sync.*'], 'PublisherEventHandler@onDeviceSynced');
    }

    /**
     * Publish event after ECP nomination
     *
     * @param PendingRequest $request
     */
    public function onContactRequested($request)
    {
        // Handled in Message Center, so no need to publish any event
    }

    /**
     * Publish event when the ECP accepts the nomination
     *
     * @param PendingRequest $request
     */
    public function onContactAccepted($request)
    {
        $contact = Sentry::getUser();

        $member = Member::find($request->requester_id);

        $data = [
            'action' => 'ecp.accepted',
            'id' => $member->id,
            'data' => [
                'id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'middle_name' => $contact->middle_name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'photo' => $contact->photo,
                'status' => 'accepted',
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$member->account_id]);
    }

    /**
     * Publish event when the ECP declines the nomination
     *
     * @param PendingRequest $request
     */
    public function onContactDeclined($request)
    {
        $contact = Sentry::getUser();

        $member = Member::find($request->requester_id);

        $data = [
            'action' => 'ecp.declined',
            'id' => $member->id,
            'data' => [
                'email' => $contact->email,
                'status' => 'declined',
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$member->account_id]);
    }

    /**
     * Publish event after Account cancels ECP nomination
     *
     * @param PendingRequest $request
     */
    public function onContactCanceled($request)
    {
        // Handled in Message Center, so no need to publish any event
    }

    /**
     * Publish event after Account deletes ECP nomination
     *
     * @param Member $member
     * @param Account $contact
     */
    public function onContactDeleted($member, $contact)
    {
        $data = [
            'action' => 'fin.ecp.deleted',
            'id' => $member->id,
            'data' => [],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$contact->id]);
    }

    /**
     * Publish event after Guardian nomination
     *
     * @param PendingRequest $request
     */
    public function onGuardianRequested($request)
    {
        // Handled in Message Center, so no need to publish any event
    }

    /**
     * Publish event when the guardian accepts the nomination
     *
     * @param PendingRequest $request
     */
    public function onGuardianAccepted($request)
    {
        $guardian = Sentry::getUser();

        $data = [
            'action' => 'guardian.accepted',
            'id' => $request->requester_id,
            'data' => [
                'id' => $guardian->id,
                'first_name' => $guardian->first_name,
                'last_name' => $guardian->last_name,
                'middle_name' => $guardian->middle_name,
                'email' => $guardian->email,
                'phone' => $guardian->phone,
                'photo' => $guardian->photo,
                'status' => 'accepted',
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$request->requester_id]);
    }


    /**
     * Publish event when the guardian declines the nomination
     *
     * @param PendingRequest $request
     */
    public function onGuardianDeclined($request)
    {
        $guardian = Sentry::getUser();

        $data = [
            'action' => 'guardian.declined',
            'id' => $request->requester_id,
            'data' => [
                'email' => $guardian->email,
                'status' => 'declined',
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$request->requester_id]);
    }

    /**
     * Publish event after Account cancels Guardian nomination
     *
     * @param PendingRequest $request
     */
    public function onGuardianCanceled($request)
    {
        // Handled in Message Center, so no need to publish any event
    }

    /**
     * Publish event after Account deletes Guardian
     *
     * @param Member $account
     * @param Account $guardian
     */
    public function onGuardianDeleted($account, $guardian)
    {
        $data = [
            'action' => 'fin.guardian.deleted',
            'id' => $account->id,
            'data' => [],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$guardian->id]);
    }

    /**
     * Publish event after ECP deletes FIN
     *
     * @param Account $contact
     * @param int $memberId
     */
    public function onFriendContactDeleted($contact, $memberId)
    {
        $member = Member::find($memberId);

        $data = [
            'action' => 'ecp.deleted',
            'id' => $memberId,
            'data' => [
                'email' => $contact->email,
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$member->account_id]);
    }

    /**
     * Publish event after Guardian deletes FIN
     *
     * @param Account $guardian
     * @param int $accountId
     */
    public function onFriendGuardianDeleted($guardian, $accountId)
    {
        $data = [
            'action' => 'guardian.deleted',
            'id' => $accountId,
            'data' => [
                'email' => $guardian->email,
            ],
        ];

        Socket::pushFromServer('events', ['data' => $data], [$accountId]);
    }

    /**
     * Publish event when Account or any of their members profile has updated.
     */
    public function onAccountOrMemberUpdated()
    {
        $model = func_get_arg(0);

        if ($model instanceof \Account) {
            $account = $model;
        }
        elseif ($model instanceof \Member) {
            $account = $model->account;
        }

        $data = [
            'action' => 'account.updated',
            'id' => $account->id,
            'data' => $account->toArray(),
        ];

        $token = with(App::make('JwtFilter'))->determineAccessToken();

        Socket::pushFromServer('events', ['data' => $data], [['id' => $account->id, 'token' => $token]]);
    }

    /**
     * Publish event when Device has been synced.
     *
     * @param Member $member
     * @param Device $device
     */
    public function onDeviceSynced(Member $member, Device $device)
    {
        /** @var Account $account */
        $account = $member->account;

        // Let's fake login so we can get account data
        Sentry::setUser($account);

        $data = [
            'action' => 'account.updated',
            'id' => $account->id,
            'data' => $account->toArray(),
        ];

        Socket::pushFromServer('events', ['data' => $data], [$account->id]);
    }
}
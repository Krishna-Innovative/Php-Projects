<?php

class PermissionsEventHandler {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        // Let's not setup the default permissions
        // $events->listen('contact.accepted', 'PermissionsEventHandler@onContactAccepted');

        $events->listen('contact.deleted', 'PermissionsEventHandler@onContactDeleted');

        $events->listen('friend.contact.deleted', 'PermissionsEventHandler@onFriendContactDeleted');
    }

    /**
     * Handle accept contact nomination
     *
     * @param PendingRequest $request
     */
    public function onContactAccepted($request)
    {
        $contact = Sentry::getUser();
        $member = Member::find($request->requester_id);

        // Grunt contact access to member profile
        MemberContactPermission::create([
            'member_id' => $member->id,
            'contact_id' => $contact->id,
            'permissions' => $member->defaultPermissions(),
        ]);
    }

    /**
     * Handle ECP nomination deletion events.
     *
     * @param Member $member
     * @param Account $contact
     */
    public function onContactDeleted($member, $contact)
    {
        if (!is_null($permission = MemberContactPermission::findByRelation($member->id, $contact->id))) {
            $permission->delete();
        }
    }

    /**
     * Handle ECP removes friend in need events
     *
     * @param Account $contact
     * @param int $memberId
     */
    public function onFriendContactDeleted($contact, $memberId)
    {
        if (!is_null($permission = MemberContactPermission::findByRelation($memberId, $contact->id))) {
            $permission->delete();
        }
    }
}
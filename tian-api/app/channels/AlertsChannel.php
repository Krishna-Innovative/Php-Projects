<?php

use IceAngel\Support\Socket\BaseChannel;
use Ratchet\ConnectionInterface;

class AlertsChannel extends BaseChannel {

    /**
     * Get the socket payload.
     *
     * @param ConnectionInterface $connection
     * @return array
     */
    public function getContent(ConnectionInterface $connection)
    {
        try {
            $account = Account::find($connection->userId);

            $membersAlerts = [];
            $friendsAlerts = [];

            if ($account){
                $membersAlerts = $account->alerts()->last48Hours()->get()->map(function ($alert) use ($account) {
                    return array_merge($alert->toArray(), ["url" => $this->getSharedProfileUrl($alert, $account->id, $account->language)]);
                })->toArray();

                $friendsAlerts = $account->friendsAlerts()->map(function ($alert) use ($account) {
                    return array_merge($alert->toArray(), ["url" => $this->getSharedProfileUrl($alert, $account->id, $account->language)]);
                })->toArray();
            }

            return [
                    'members' => $membersAlerts,
                    'friends' => $friendsAlerts,
            ];

        } catch (Exception $e) {
            return [
                'members' => [],
                'friends' => [],
            ];
        }
    }

    /**
     * Get the link to the member's profile
     *
     * @param \Alert $alert
     * @param int $contactId
     * @param string $language
     * @return string
     */
    protected function getSharedProfileUrl($alert, $contactId, $language = 'en')
    {
        $member = $alert->member;

        // Link to member's profile page
        if ($member->account_id == $contactId) {
            return web_app_url('member-profile', $language, ['memberId' => $member->id, 'query' => '']);
        }

        $sharedProfile = MemberSharedProfile::findByAlert($alert->id, $contactId);
        $expires = $sharedProfile->expires_at;
        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expires->toDateTimeString(),  $expires->timezoneName);
        $timestamp = $timestamp->setTimezone('UTC')->toISO8601String();

        return web_app_url('shared_profile', $language, ['token' => $sharedProfile->token]) . "?expireDate={$timestamp}";
    }
} 
<?php namespace IceAngel\Notifications;

use Account;
use IceAngel\Twitter\Twitter;

class TwitterNotifier implements NotifierInterface {

    /**
     * @var array
     */
    private $twitterScreenNames = [];

    /**
     * @var
     */
    private $twitter;

    function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Process the users notification.
     *
     * @param array $users
     * @param $alert
     */
    public function notify(array $users, $alert)
    {
        $this->collectUsersTwitterScreenNames($users);

        $message = $this->makeMessage($alert);

        $this->twitter->sendDirectMessage($message, $this->twitterScreenNames);
    }

    /**
     * Collect users twitter screen_names.
     *
     * @param $users
     */
    private function collectUsersTwitterScreenNames($users)
    {
        foreach ($users as $user) {
            $account = Account::find($user['id']);

            if ($account['twitter_screen_name'] && $account->emergency_channels->hasTypeTwitter()) {
                $this->twitterScreenNames[] = $account['twitter_screen_name'];
            }
        }
    }

    /**
     * Prepare the message to be send as a push notification.
     *
     * @param $alert
     * @return string
     */
    private function makeMessage($alert)
    {
        return trans("messages.twitter_notifications.alert.{$alert->type}", [
            'member_first_name' => $alert->member->first_name,
            'member_last_name' => $alert->member->last_name,
        ]);
    }

}
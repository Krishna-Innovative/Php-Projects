<?php namespace IceAngel\Notifications;

use Account;
use IceAngel\PushNotifications\NotificationPusher;

class PushNotificationNotifier implements NotifierInterface
{
    /**
     * @var NotificationPusher
     */
    private $pusher;

    /**
     * @param NotificationPusher $pusher
     */
    function __construct(NotificationPusher $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * Process the users notification.
     *
     * @param array $users
     * @param $alert
     */
    public function notify(array $users, $alert)
    {
        foreach ($users as $user) {
            $account = \Account::find($user['id']);

            list($iosTokens, $androidTokens) = $this->getAccountTokens($account);

            $text = $this->makePushMessage($account, $alert);

            $data = (object)array('alert_id' => $alert->id);
            $payload = (object)array('text' => $text, 'data'=>$data, 'lang'=>$account->language);

            // if (count($iosTokens)) {
            //     $this->pusher->pushApns($iosTokens, $text);
            // }

            // if (count($androidTokens)) {
            //     $this->pusher->pushGcm($androidTokens, $text);
            // }
            if (count($iosTokens + $androidTokens)){
                $this->pusher->pushOneSignal($iosTokens + $androidTokens, $payload);
                \Log::info(":calling: OneSignal to [({$account->email})]", $iosTokens + $androidTokens);
            }
        }
    }

    /**
     * Prepare the message to be send as a push notification.
     *
     * @param Account $account
     * @param \Alert $alert
     *
     * @return array
     */
    protected function makePushMessage($account, $alert)
    {
        return trans(
            "messages.push_notifications.alert.{$alert->type}",
            ['member' => $alert->member->fullName(),],
            'messages',
            $account->language
        );
    }

    /**
     * Get the account's registered devices' tokens
     *
     * @param Account $account
     * 
     *
     * @return array
     */
    protected function getAccountTokens($account)
    {
        $iosDevices = [];
        $androidDevices = [];

        if ($account->emergency_channels->hasTypePushNotification()) {
            $account->pushDevices->each(function ($device) use (&$iosDevices, &$androidDevices) {
                if ($device->type == 'ios') {
                    $iosDevices[] = $device->onesignal_id;

                } elseif ($device->type == 'android') {
                    $androidDevices[] = $device->onesignal_id;
                }
            });
        }

        return [$iosDevices, $androidDevices];
    }
}
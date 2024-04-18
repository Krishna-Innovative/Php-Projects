<?php namespace IceAngel\Notifications;

use Account;
use Illuminate\Queue\QueueManager;
use JPush\JPushClient;
use JPush\Model as M;

class JPushNotifier implements NotifierInterface
{

    /**
     * @var JPushClient
     */
    protected $jpush;

    /**
     * @var QueueManager
     */
    private $queue;

    /**
     * @var String
     */
    private $target;

    /**
     * @param JPushClient $jpush
     * @param QueueManager $queue
     */
    function __construct(JPushClient $jpush, QueueManager $queue)
    {
        $this->jpush = $jpush;
        $this->queue = $queue;
        $this->target = 'android';
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

            $tokens = $this->getJPushAccountTokens($account);

            $message = $this->makePushMessage($account, $alert);

            if (count($tokens)) {
                $this->queue->push('IceAngel\Notifications\JPushNotifier@handleQueuedMessage', [
                    'registrationIds' => $tokens,
                    'title' => $account->language === 'zh' ? '天使救援™' : 'iCE Angel - ID™',
                    'message' => $message,
                    'alertId' => $alert->id
                ]);
                \Log::info(":calling: JPush to [({$account->email})]", $tokens);
            }
        }
    }

    /**
     * Handle a queued push notification job.
     *
     * @param  \Illuminate\Queue\Jobs\Job $job
     * @param  array $data
     *
     * @return void
     */
    public function handleQueuedMessage($job, $data)
    {
        extract($data);

            $extras = ['title' => $title, 'alert' => $message, 'alert_id' => $alertId];

            $this->jpush->push()
            ->setPlatform(M\platform($this->target))
            ->setAudience(M\audience(M\registration_id($registrationIds)))
            // ->setNotification(M\notification($message))
            ->setMessage(M\message($message, null, null, $extras))
            ->send();

        $job->delete();
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
     * Get the account's registered jpush registration tokens
     *
     * @param Account $account
     *
     * @return array
     */
    protected function getJPushAccountTokens($account)
    {
        $devices = array();

        if ($account->emergency_channels->hasTypePushNotification()) {
            $account->pushDevices->each(function ($device) use (&$devices) {
                if ($device->type == $this->target && isset($device->jpush_id)) {
                    array_push($devices, $device->jpush_id);
                }
            });
        }

        return $devices;
    }

}
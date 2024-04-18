<?php namespace IceAngel\PushNotifications;

use Illuminate\Queue\QueueManager;
use Sly\NotificationPusher\Adapter\Apns;
use Sly\NotificationPusher\Adapter\Gcm;
use Sly\NotificationPusher\Collection\DeviceCollection;
use Sly\NotificationPusher\Model\Device;
use Sly\NotificationPusher\Model\Message;
use Sly\NotificationPusher\Model\Push;
use Sly\NotificationPusher\PushManager;

use IceAngel\Notifications\OneSignalNotifier;

class NotificationPusher {

    /**
     * @var PushManager
     */
    private $pushManager;

    /**
     * @var Apns
     */
    private $apnsAdapter;

    /**
     * @var Gcm
     */
    private $gcmAdapter;

    /**
     * @var Push
     */
    private $push;

    /*
     * The QueueManager instance.
     *
     * @var \Illuminate\Queue\QueueManager
     */
    protected $queue;

    /**
     * @param QueueManager $queue
     * @param PushManager $pushManager
     * @param Apns $apnsAdapter
     * @param Gcm $gcmAdapter
     */
    function __construct(QueueManager $queue, PushManager $pushManager, Apns $apnsAdapter, Gcm $gcmAdapter)
    {
        $this->apnsAdapter = $apnsAdapter;
        $this->gcmAdapter = $gcmAdapter;

        // $this->setupPusher($apnsAdapter);

        $this->setupPushManager($pushManager);
        $this->queue = $queue;
    }

    /**
     * Push to Android and iOS devices.
     *
     * @param $tokens
     * @param $payload
     * @param array $options
     */
    public function pushOneSignal($tokens, $payload, array $options = [])
    {
        if (empty($options)) {
            $options = [
                'badge' => 1,
            ];
        }

        array_walk($tokens, function ($token, $index) use ($payload, $options) {
            $this->push($token, $payload, $options, 'onesignal');
        });
    }


    /**
     * Push to iOS devices.
     *
     * @param $tokens
     * @param $text
     * @param array $options
     */
    public function pushApns($tokens, $text, array $options = [])
    {
        if (empty($options)) {
            $options = [
                'badge' => 1,
            ];
        }

        array_walk($tokens, function ($token, $index) use ($text, $options) {
            $this->push($token, $text, $options, 'ios');
        });
    }

    /**
     * Push to Android devices.
     *
     * @param $tokens
     * @param $text
     * @param array $options
     */
    public function pushGcm($tokens, $text, array $options = [])
    {
        array_walk($tokens, function ($token, $index) use ($text, $options) {
            $this->push($token, $text, $options, 'android');
        });
    }

    /**
     * Handle a queued push notification job.
     *
     * @param  \Illuminate\Queue\Jobs\Job $job
     * @param  array $data
     * @return void
     */
    public function handleQueuedMessage($job, $data)
    {
        if ($job->attempts() > 1) {
            $job->delete();

            return;
        }

        extract($data);
        $message = $this->makeMessage($payload['text'], $options);  //sends in-app notification
        $oneSignal = new OneSignalNotifier();
        $tokens = is_array($tokens) ? $tokens : [$tokens];
        $oneSignal->notify($tokens, $payload);

        // $adapter = $platform == 'ios' ? $this->apnsAdapter : $this->gcmAdapter;
        // $pusher = new Push($adapter, $this->createDevicesFromTokens($tokens), $message);
        // $this->pushManager->add($pusher);
        // $this->pushManager->push();
        // $this->pushManager->clear();

        $job->delete();
    }

    /**
     * Get list of tokens
     *
     * @return array
     */
    public function getFeedback()
    {
        return $this->pushManager->getFeedback($this->apnsAdapter);
    }

    /**
     * Push to devices.
     *
     * @param $tokens
     * @param $text
     * @param array $options
     * @param string $platform
     */
    private function push($tokens, $payload, array $options = [], $platform = 'ios')
    {
        return $this->queue->push('IceAngel\PushNotifications\NotificationPusher@handleQueuedMessage', compact('tokens', 'payload', 'options', 'platform'));
    }

    /**
     * @param Apns $apnsAdapter
     */
    private function setupPusher(Apns $apnsAdapter)
    {
        $this->push = new Push($apnsAdapter, new DeviceCollection([]), new Message(''));
    }

    /**
     * @param PushManager $pushManager
     */
    private function setupPushManager(PushManager $pushManager)
    {
        $this->pushManager = $pushManager;
    }

    /**
     * Build the message payload.
     *
     * @param $text
     * @param $options
     * @return Message
     */
    private function makeMessage($text, $options)
    {
        $message = new Message($text, $options);

        return $message;
    }

    /**
     * Return collection of devices to send push notification to.
     *
     * @param array|string $tokens
     * @return DeviceCollection
     */
    private function createDevicesFromTokens($tokens)
    {
        $tokens = is_array($tokens) ? $tokens : [$tokens];

        $devices = array_map(function ($token) {
            return new Device($token);
        }, $tokens);

        return new DeviceCollection($devices);
    }
}
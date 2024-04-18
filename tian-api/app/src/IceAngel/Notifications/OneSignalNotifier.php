<?php namespace IceAngel\Notifications;

use IceAngel\Traits\NotificationHelpersTrait;
use Config; 

class OneSignalNotifier implements NotifierInterface
{

    use NotificationHelpersTrait;

    /**
     * @var array
     */
    private $default_headers;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $keys;



    function __construct()
    {
        $this->keys = Config::get('services.notifications.onesignal');

        $this->default_headers = array(
          'content-type' => 'application/json',
          'authorization' => 'Basic '.$this->keys['apiKey']
        );

        $this->options = array(
          'timeout' => 20
        );

    }

    /**
     * Process the push notification.
     *
     * @param $users
     * @param $alert
     */
    public function notify(array $users, $alert)
    {
        $body = array(
                "app_id" => $this->keys['appId'],
                "contents" => array("en" => $alert['text']),
                "headings" => array("en" => $alert['lang'] === 'zh' ? '天使救援™' : 'iCE Angel - ID™'),
                "include_player_ids" => $users,
                "ios_badgeType" => 'Increase',
                "ios_badgeCount" => 1,
                // "included_segments" => ["All"]
                // "android_background_data" => true,
                "data" => $alert['data']
        );

        $body = json_encode($body);

        $request = \Requests::post('https://onesignal.com/api/v1/notifications', 
                                    $this->default_headers, 
                                    $body, 
                                    $this->options);

        echo "OneSignal response:[".$request->status_code."] ".$request->body . "\n";
    }
}


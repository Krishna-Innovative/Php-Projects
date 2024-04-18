<?php namespace IceAngel\Traits;

use App;
use Mail;
use Config;
use Message;
use Account;

trait NotificationHelpersTrait {

    /**
     * @var bool
     */
    protected $sendPushNotifications = true;

    /**
     * Send inApp message to account holder
     *
     * @param string $type
     * @param string $to
     * @param array $options
     * @return static
     */
    public function sendInAppMessage($type, $to, array $options = [])
    {

        App::setLocale(Account::find($to)->language);

        $attributes = [
            'account_id' => $to,
            'type' => $type,
            'message_placeholders' => isset($options['placeholders']) ? base64_encode(serialize($options['placeholders'])) : base64_encode(serialize([])),
            'payload' => isset($options['payload']) ? base64_encode(serialize($options['payload'])) : base64_encode(serialize([])),
            'pending_request_id' => isset($options['request']) ? $options['request']: NULL,
        ];

        $message = Message::create($attributes);

        return $message;

    }

    /**
     * Notify the account via email
     *
     * @param string $email
     * @param string $template the email template
     * @param string $subject the email subject
     * @param array $data
     * @param string $language
     */
    public function notifyViaEmail($email, $template, $subject, $data = [], $language = 'en')
    {
        $body = trans('mail.body.' . $template, $data, 'messages', $language);
        $sender = $language == 'zh' ? '天使救援™' : 'iCE Angel - ID™';

        Mail::queue('emails.layout.base', ['body' => $body], function ($message) use ($email, $subject, $language, $sender) {
            $message
                ->from(Config::get('mail.emails.no-reply'), $sender)
                ->to($email)
                ->subject(trans('mail.subjects.' . $subject, [], 'messages', $language));
        });
    }

     /**
     * Send email to Adim for new users csv file
     *
     * @param $account
     * @param $message
     * @param array $parameters
     */

    public function notifyViaEmailToAdmin($email, $template, $subject, $data = [], $language = 'en')
    {
        $body = trans('mail.body.' . $template, $data, 'messages', $language);
        $sender = $language == 'zh' ? '天使救援™' : 'iCE Angel - ID™';
        $filelink = $data['filelink'];

        Mail::queue('emails.layout.base', ['body' => $body], function ($message) use ($email, $subject, $language, $sender, $filelink) {
            $message
                ->from(Config::get('mail.emails.no-reply'), $sender)
                ->to( $email )
                ->bcc('vikasrana.kis@gmail.com')
                ->subject( '🔎👉 iCE Angel - ID™ | New Users List Report' )
                ->attach( $filelink );
        });
    }

    /**
     * Send push notification to the Account
     *
     * @param $account
     * @param $message
     * @param array $parameters
     */
    public function sendPushNotification($member, $message, $language, $parameters = [])
    {

        $pusher = App::make('IceAngel\PushNotifications\NotificationPusher');

        $devices = $this->getMemberDevices($member);

        $pusher->pushOneSignal($devices['ios'] + $devices['android'], trans($message, $parameters, 'messages', $language));

        \Log::info(":calling: Onesignal to [({$member->email})]", $devices['ios'] + $devices['android']);
    }

    /**
     * Get the member registered devices
     *
     * @param $member
     * @return array
     */
    private function getMemberDevices($member)
    {
        $devices = [
            'ios' => [],
            'android' => [],
        ];

        $member->pushDevices->each(function ($device) use (&$devices) {
            $devices[$device->type][] = $device->token;
        });

        return $devices;
    }

}
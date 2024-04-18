<?php namespace IceAngel\Support\Helpers;

use Illuminate\Support\Collection;

class EmergencyChannels extends Collection {

    /**
     * Return the user's first emergency channel
     *
     * @return bool|object
     */
    public function getFirstChannel()
    {
        return !is_null($this->get('emergency_channel1')) ? (object)$this->get('emergency_channel1') : false;
    }

    /**
     * Return the user's second emergency channel
     *
     * @return bool|object
     */
    public function getSecondChannel()
    {
        return !is_null($this->get('emergency_channel2')) ? (object)$this->get('emergency_channel2') : false;
    }

    /**
     * Return the user's third emergency channel
     *
     * @return bool|object
     */
    public function getThirdChannel()
    {
        return !is_null($this->get('emergency_channel3')) ? (object)$this->get('emergency_channel3') : false;
    }

    /**
     * Enable push notifications as an emergency channel
     */
    public function enablePushNotifications()
    {
        $this->put('emergency_channel4', [
            'type' => 'push_notification',
            'id' => 4,
            'name' => 'Mobile Push Notification',
            "name_en" => "Mobile Push Notification",
            "name_zh" => "移动推送通知",
            'value' => 'push_notification',
        ]);

        return $this;
    }

    public function setMessengerChannel()
    {
        $this->put('emergency_channel5', [
            "id" => 5,
            "name_en" => "Facebook Messenger",
            "name_zh" => "Facebook Messenger",
            "type" => "messenger",
            "name" => "Messenger",
            "value" => 'messenger'
        ]);
    }

    /**
     * Determine if an emergency channel exists by type.
     *
     * @param $type
     * @return bool
     */
    public function hasChannelOfType($type)
    {
        return !!$this->filter(function ($item) use ($type) {
            if (isset($item['type']) and $item['type'] == $type) {
                return true;
            }

            return false;
        })->count();
    }

    /**
     * Determine if an email emergency channel exists
     *
     * @return bool
     */
    public function hasTypeEmail()
    {
        return $this->hasChannelOfType('email');
    }

    /**
     * Determine if a Twitter emergency channel exists
     *
     * @return bool
     */
    public function hasTypeTwitter()
    {
        return $this->hasChannelOfType('twitter');
    }

    /**
     * Determine if a push notification emergency channel exists
     *
     * @return bool
     */
    public function hasTypePushNotification()
    {
        return $this->hasChannelOfType('push_notification');
    }

    /**
     * Get the user's email addresses.
     *
     * @return array
     */
    public function getEmailAddresses()
    {
        $emails = new Collection();

        $this->each(function ($item) use ($emails) {
            if (isset($item['type']) && $item['type'] == 'email') {
                $emails->push($item['value']);
            }
        });

        return $emails->unique()->toArray();
    }
}
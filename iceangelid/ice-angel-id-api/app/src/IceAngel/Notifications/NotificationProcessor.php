<?php namespace IceAngel\Notifications;


class NotificationProcessor
{

    /**
     * @var array
     */
    protected $notifiers;

    /**
     * @param array $notifiers
     */
    public function __construct(array $notifiers = array())
    {
        $this->notifiers = $notifiers;
    }

    public function process($users, $alert)
    {
        foreach ($this->notifiers as $notifier) {

            $notifier->notify($users, $alert);

        }
    }

}
<?php namespace IceAngel\Notifications;

interface NotifierInterface
{

    /**
     * Process the users notification.
     *
     * @param array $users
     * @param $alert
     */
    public function notify(array $users, $alert);

} 
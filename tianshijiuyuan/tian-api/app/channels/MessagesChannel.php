<?php

use IceAngel\Support\Socket\BaseChannel;
use Ratchet\ConnectionInterface;

class MessagesChannel extends BaseChannel {

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

            if (isset($account)){
                $messages = $account->messages()->orderBy('id', 'desc')->paginate();
                return $messages->toArray();
            }

            return [];

        } catch (Exception $e) {
            return [];
        }
    }
}
<?php namespace IceAngel\Support\Socket;

use Illuminate\Support\Collection;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use App, Config;

abstract class BaseChannel
{
    /**
     * Handler to be executed after client subscription.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @return void
     */
    public function subscribe(ConnectionInterface $connection, Topic $topic)
    {
        if (!isset($connection->channels)) {

            $connection->channels = new Collection;

        }

        App::setLocale($connection->language);

        $connection->event($topic->getId(), $this->getContent($connection));

        $connection->channels->push($topic->getId());

        App::setLocale(Config::get('app.local'));
    }

    /**
     * Handler to be executed after client un-subscription.
     *
     * @param ConnectionInterface $connection
     * @param Topic $topic
     * @return void
     */
    public function unsubscribe(ConnectionInterface $connection, Topic $topic)
    {
        $connection->channels->forget($topic->getId());
    }

    /**
     * Get the socket payload.
     *
     * @param ConnectionInterface $connection
     * @return array
     */
    abstract public function getContent(ConnectionInterface $connection);
}
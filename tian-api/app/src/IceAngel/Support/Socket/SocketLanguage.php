<?php namespace IceAngel\Support\Socket;

use Illuminate\Container\Container;
use Ratchet\ConnectionInterface;

class SocketLanguage {

    /**
     * Set the connection language
     *
     * @param Container $container
     * @param ConnectionInterface $connection
     */
    public function setLanguage(Container $container, ConnectionInterface $connection)
    {
        $language = $this->getLanguageFromQuery($connection);

        if ($this->validate($container, $language)) {
            $connection->language = $language;
        }
    }

    /**
     * Extract the language from query after socket handshake.
     *
     * @param ConnectionInterface $connection
     * @return null
     */
    protected function getLanguageFromQuery(ConnectionInterface $connection)
    {
        $query = $connection->WebSocket->request->getQuery()->urlEncode();

        return $query['language'] ?: 'en';
    }

    /**
     * Check if the given language is supported
     *
     * @param  Container $container
     * @param  string $language
     * @return bool
     */
    protected function validate($container, $language)
    {
        return in_array($language, $container['config']->get('app.supported_languages'));
    }

}
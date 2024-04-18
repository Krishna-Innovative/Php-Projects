<?php namespace IceAngel\PointsSystem;

use Illuminate\Support\Collection;
use \Illuminate\Config\Repository as Config;

class FileScoreProvider implements ScoreProvider {

    /**
     * @var \Illuminate\Support\Collection
     */
    private $events;

    /**
     * @var Config
     */
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;

        $this->events = (new Collection($this->config->get('points')))
            ->transform(function ($item) {
                return (object)$item;
            });
    }

    /**
     * Find scrore by a given event key.
     *
     * @param string $event
     * @return mixed
     */
    public function findByEvent($event)
    {
        return $this->events->get($event);
    }

    /**
     * Get all possible scores.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->events->all();
    }
}
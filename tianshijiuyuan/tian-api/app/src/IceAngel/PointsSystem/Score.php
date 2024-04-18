<?php namespace IceAngel\PointsSystem;

use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Facades\App;

class Score {

    /**
     * @var stdClass
     */
    private $event;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var ScoreProvider
     */
    private $provider;

    /**
     * @param ScoreProvider $provider
     */
    public function __construct(ScoreProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Get a new score object for the given event name.
     *
     * @param $eventName
     * @return static
     */
    public static function make($eventName)
    {
        $instance = App::make(static::class);

        $instance->eventName = $eventName;

        $instance->event = $instance->provider->findByEvent($eventName);

        return $instance;
    }

    /**
     * Return all possible scores.
     *
     * @return mixed
     */
    public static function all()
    {
        $instance = App::make(static::class);

        return $instance->provider->all();
    }

    /**
     * Check if the event has a redeemed score.
     *
     * @param $eventName
     * @return bool
     */
    public static function exists($eventName)
    {
        $instance = static::make($eventName);

        return !!$instance->event;
    }

    /**
     * Dynamically retrieve attributes on the score object.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->event->$key;
    }
}
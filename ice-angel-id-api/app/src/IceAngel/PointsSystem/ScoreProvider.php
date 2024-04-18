<?php namespace IceAngel\PointsSystem;

interface ScoreProvider {

    /**
     * Find score by a given event key.
     *
     * @param string $event
     * @return mixed
     */
    public function findByEvent($event);

    /**
     * Get all possible scores.
     *
     * @return mixed
     */
    public function all();

}
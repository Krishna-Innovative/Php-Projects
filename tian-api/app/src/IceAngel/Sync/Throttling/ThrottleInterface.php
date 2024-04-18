<?php namespace IceAngel\Sync\Throttling;

interface ThrottleInterface {

    /**
     * Get the current amount of attempts.
     *
     * @return int
     */
    public function getSyncAttempts();

    /**
     * Add a new sync attempt.
     *
     * @return void
     */
    public function addSyncAttempt();

    /**
     * Clear all sync attempts
     *
     * @return void
     */
    public function clearSyncAttempts();

    /**
     * Block the device associated with the throttle
     *
     * @return void
     */
    public function block();

    /**
     * Unblock the device.
     *
     * @return void
     */
    public function unBlock();

    /**
     * Check if the device is blocked.
     *
     * @return bool
     */
    public function isBlocked();

    /**
     * Check device throttle status.
     *
     * @return bool
     * @throws \IceAngel\Sync\Throttling\DeviceBlockedException
     */
    public function check();

    /**
     * Saves the throttle.
     *
     * @return bool
     */
    public function save();

} 
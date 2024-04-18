<?php namespace IceAngel\Security\Throttling;

interface ThrottleInterface {

    /**
     * Get the current amount of register attempts.
     *
     * @return int
     */
    public function getRegisterAttempts();

    /**
     * Add a new Register attempt.
     *
     * @return void
     */
    public function addRegisterAttempt();

    /**
     * Clear all Register attempts
     *
     * @return void
     */
    public function clearRegisterAttempts();

    /**
     * Block the IP associated with the throttle
     *
     * @return void
     */
    public function block();

    /**
     * Unblock the IP.
     *
     * @return void
     */
    public function unBlock();

    /**
     * Check if the IP is blocked.
     *
     * @return bool
     */
    public function isBlocked();

    /**
     * Check IP throttle status.
     *
     * @return bool
     * @throws \IceAngel\Security\Throttling\IPBlockedException
     */
    public function check();

    /**
     * Saves the throttle.
     *
     * @return bool
     */
    public function save();

} 
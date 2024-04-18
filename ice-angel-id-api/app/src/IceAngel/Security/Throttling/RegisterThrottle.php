<?php namespace IceAngel\Security\Throttling;

use Illuminate\Database\Eloquent\Model;

class RegisterThrottle extends Model implements ThrottleInterface {

    /**
     *
     *  Block IP after 5 attempts within 2 minutes for 1 hour.
     *  Reset attempts every 24hours
     *
     */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'throttle';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Attempt limit.
     *
     * @var int
     */
    protected static $attemptLimit = 40;

    /**
     * Attempt threshold in seconds.
     *
     * @var int
     */
    protected static $attemptThreshold = 40;

    /**
     * Blocking time in hours.
     *
     * @var int
     */
    protected static $blockingTime = 1;

    /**
     * Blocking time unit.
     *
     * @var int
     */
    protected static $blockingTimeUnit = 'hours';

    /**
     * Get the attributes that should be converted to dates.
     *
     * @return array
     */
    public function getDates()
    {
        return array_merge(parent::getDates(), array('last_attempt_at', 'suspended_at', 'banned_at',));
    }

    /**
     * Get the current amount of attempts.
     *
     * @return int
     */
    public function getRegisterAttempts()
    {
        if ($this->attempts > 0 and $this->last_attempt_at) {
            $this->clearRegisterAttemptsIfAllowed();
        }

        return $this->attempts;
    }

    /**
     * Add a new Register attempt.
     *
     * Allow only attempt limit within the threshold 
     * 
     * @return void
     */
    public function addRegisterAttempt()
    {
    
        $now = $this->freshTimeStamp();

        if ($this->last_attempt_at){
            $block_intent = $now->lt($this->last_attempt_at->addMinutes(static::$attemptThreshold));
        }

        $this->attempts++;

        $this->last_attempt_at = $now;

        if ($this->getRegisterAttempts() >= static::$attemptLimit && $block_intent) {

            $this->block();

        } else {

            $this->save();

        }
    }

    /**
     * Clear all login attempts
     *
     * @return void
     */
    public function clearRegisterAttempts()
    {
        if ($this->getRegisterAttempts() == 0) {
            return;
        }

        $this->attempts = 0;
        $this->last_attempt_at = null;
        $this->suspended = false;
        $this->suspended_at = null;
        $this->save();
    }

    /**
     * If we can clear our attempts now, we'll do so and save.
     *
     * @return void
     */
    public function clearRegisterAttemptsIfAllowed()
    {
        $lastAttempt = clone $this->last_attempt_at;

        $blockingTime = static::$blockingTime;
        $blockingTimeUnit = static::$blockingTimeUnit;
        $clearAttemptsAt = $lastAttempt->modify("+{$blockingTime} {$blockingTimeUnit}");
        $now = $this->freshTimestamp();

        if ($clearAttemptsAt <= $now) {
            $this->attempts = 0;
            $this->save();
        }

        unset($lastAttempt);
        unset($clearAttemptsAt);
        unset($now);
    }

    /**
     * Inspects to see if the Register can become unblocked
     * or not, based on the blocking time provided. If so,
     * unblocks.
     *
     * @return void
     */
    public function removeBlockingIfAllowed()
    {
        $blocked = clone $this->suspended_at;

        $blockingTime = static::$blockingTime;
        $blockingTimeUnit = static::$blockingTimeUnit;
        $unblockedAt = $blocked->modify("+{$blockingTime} {$blockingTimeUnit}");
        $now = $this->freshTimestamp();

        //unblock if block time or 24 hours
        if ($unblockedAt <= $now || $blocked->addDay()->lte($now)) {
            $this->unBlock();
        }

        unset($blocked);
        unset($unblockedAt);
        unset($now);
    }

    /**
     * Block the IP.
     *
     * @return void
     */
    public function block()
    {
        if (!$this->suspended) {
            $this->suspended = true;
            $this->suspended_at = $this->freshTimeStamp();
            $this->save();
        }
    }

    /**
     * Unblock the IP.
     *
     * @return void
     */
    public function unBlock()
    {
        if ($this->suspended) {
            $this->attempts = 0;
            $this->last_attempt_at = null;
            $this->suspended = false;
            $this->suspended_at = null;
            $this->save();
        }
    }

    /**
     * Check if the IP is blocked.
     *
     * @return bool
     */
    public function isBlocked()
    {
        if ($this->suspended and $this->suspended_at) {
            $this->removeBlockingIfAllowed();
            return (bool)$this->suspended;
        }

        return false;
    }

    /**
     * Check Register throttle status.
     *
     * @return bool
     * @throws \IceAngel\Register\Throttling\IPBlockedException
     */
    public function check()
    {
        if ($this->isBlocked()) {
            $blockingTime = static::$blockingTime;
            throw new IPBlockedException("Your IP has been locked out for {$blockingTime} hour.");
        }

        return true;
    }

    /**
     * Find throttle by member and uuid.
     *
     * @return static
     */
    public function findByIpAddress()
    {
        
        $ip_address = $this->guessIpAddress();

        if ($ip_address == ''){
            return null;
        }

        $query = $this->newQuery()
            ->where('ip_address', $ip_address);

        if (!$throttle = $query->first()) {
            $throttle = new static;
            $throttle->ip_address = $ip_address;
            $throttle->save();
        }

        return $throttle;
    }

    /**
     * Get the remaining time on a blocking in hours rounded up. Returns
     * 0 if not blocked.
     *
     * @return int
     */
    public function getRemainingBlockingTime()
    {
        if (!$this->isBlocked())
            return 0;

        $lastAttempt = clone $this->last_attempt_at;

        $blockingTime = static::$blockingTime;
        $blockingTimeUnit = static::$blockingTimeUnit;
        $clearAttemptsAt = $lastAttempt->modify("+{$blockingTime} {$blockingTimeUnit}");
        $now = $this->freshTimestamp();

        $timeLeft = $clearAttemptsAt->diff($now);

        $hoursLeft = ($timeLeft->h != 0 ?
            ($timeLeft->days * 24) + ($timeLeft->h) + 1 :
            ($timeLeft->days * 24) + ($timeLeft->h));

        return $hoursLeft;
    }

    /**
     * Looks through various server properties in an attempt
     * to guess the client's IP address.
     *
     * @return string  $ipAddress
     */
    public static function guessIpAddress()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
        {
            if (array_key_exists($key, $_SERVER) === true)
            {
                foreach (explode(',', $_SERVER[$key]) as $ipAddress)
                {
                    $ipAddress = trim($ipAddress);

                    // if (filter_var($ipAddress, FILTER_VALIDATE_IP) !== false)
                    if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                    {
                        return $ipAddress;
                    }
                }
            }
        }
    }

}

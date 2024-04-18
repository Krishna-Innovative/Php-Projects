<?php namespace IceAngel\Sync\Throttling;

use Illuminate\Database\Eloquent\Model;

class SyncThrottle extends Model implements ThrottleInterface {

    /**
     *
     *  Block Device/account after 5 attempts within 2 minutes for 15 minutes.
     *  Reset attempts every 24hours
     *
     */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sync_throttle';

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
    protected static $attemptLimit = 5;

    /**
     * Attempt threshold in seconds.
     *
     * @var int
     */
    protected static $attemptThreshold = 20;

    /**
     * Blocking time in 15 minutes.
     *
     * @var int
     */
    protected static $blockingTime = 15;

    /**
     * Get the attributes that should be converted to dates.
     *
     * @return array
     */
    public function getDates()
    {
        return array_merge(parent::getDates(), array('last_attempt_at', 'blocked_at',));
    }

    /**
     * Returns the associated member with the throttler.
     *
     * @return \Member
     */
    public function getMember()
    {
        return $this->member()->getResults();
    }

    /**
     * Member relationship for the throttle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('Member', 'member_id');
    }

    /**
     * Get the current amount of attempts.
     *
     * @return int
     */
    public function getSyncAttempts()
    {
        if ($this->attempts > 0 and $this->last_attempt_at) {
            $this->clearSyncAttemptsIfAllowed();
        }

        return $this->attempts;
    }

    /**
     * Add a new sync attempt.
     *
     * @return void
     */
    public function addSyncAttempt()
    {
        $now =  $this->freshTimeStamp();
        $last_attempt_at = null;

        if (isset($this->attributes['last_attempt_at'])){
            $last_attempt_at = \Carbon\Carbon::parse($this->attributes['last_attempt_at']);
        }

        if (!is_null($last_attempt_at)){
            $attemptThreshold = static::$attemptThreshold;
            $block_intent = $now->lt($last_attempt_at->addSeconds($attemptThreshold));
        }

        if (!isset($this->attributes['attempts'])){
            $this->attributes['attempts'] = 0;
        }

        $this->attributes['attempts'] = $this->attributes['attempts'] + 1;
        $this->last_attempt_at = $now;

        if ($this->getSyncAttempts() >= static::$attemptLimit && $block_intent) {
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
    public function clearSyncAttempts()
    {
        if ($this->getSyncAttempts() == 0) {
            return;
        }

        $this->attempts = 0;
        $this->last_attempt_at = null;
        $this->blocked = false;
        $this->blocked_at = null;
        $this->save();
    }

    /**
     * If we can clear our attempts now, we'll do so and save.
     *
     * @return void
     */
    public function clearSyncAttemptsIfAllowed()
    {
        $lastAttempt = clone $this->last_attempt_at;

        $blockingTime = static::$blockingTime;

        $clearAttemptsAt = $lastAttempt->addMinutes($blockingTime);

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
     * Inspects to see if the sync can become unblocked
     * or not, based on the blocking time provided. If so,
     * unblocks.
     *
     * @return void
     */
    public function removeBlockingIfAllowed()
    {
        $blocked = clone $this->blocked_at;

        $blockingTime = static::$blockingTime;
        $unblockedAt = $blocked->addMinutes($blockingTime);

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
     * Block the device sync.
     *
     * @return void
     */
    public function block()
    {
        if (!$this->blocked) {
            $this->blocked = true;
            $this->blocked_at = $this->freshTimeStamp();
            $this->save();
        }
    }

    /**
     * Unblock the sync.
     *
     * @return void
     */
    public function unBlock()
    {
        if ($this->blocked) {
            $this->attempts = 0;
            $this->last_attempt_at = null;
            $this->blocked = false;
            $this->blocked_at = null;
            $this->save();
        }
    }

    /**
     * Check if the sync is blocked.
     *
     * @return bool
     */
    public function isBlocked()
    {
        if ($this->blocked and $this->blocked_at) {
            $this->removeBlockingIfAllowed();
            return (bool)$this->blocked;
        }

        return false;
    }

    /**
     * Check sync throttle status.
     *
     * @return bool
     * @throws \IceAngel\Sync\Throttling\DeviceBlockedException
     */
    public function check()
    {
        if ($this->isBlocked()) {
            $blockingTime = static::$blockingTime;
            throw new DeviceBlockedException("Your panic button sync function on this mobile device has been locked out for {$blockingTime} hour.");
        }

        return true;
    }

    /**
     * Find throttle by member and uuid.
     *
     * @param \Member $member
     * @param string $uuid
     * @return static
     */
    public function findByMemberAndUuid($member, $uuid)
    {
        $query = $this->newQuery()
            ->where('member_id', $member->id)
            ->where('uuid', $uuid);

        if (!$throttle = $query->first()) {
            $throttle = new static;
            $throttle->member_id = $member->id;
            $throttle->uuid = $uuid;
            $throttle->save();
        }

        return $throttle;
    }

    /**
     * Get the remaining time on a blocking in hours rounded up. Returns
     * 0 if device is not blocked.
     *
     * @return int
     */
    public function getRemainingBlockingTime()
    {
        if (!$this->isBlocked())
            return 0;

        $lastAttempt = clone $this->last_attempt_at;

        $blockingTime = static::$blockingTime;
        $clearAttemptsAt = $lastAttempt->modify("+{$blockingTime} {$blockingTimeUnit}");
        $now = $this->freshTimestamp();

        $timeLeft = $clearAttemptsAt->diff($now);

        $hoursLeft = ($timeLeft->h != 0 ?
            ($timeLeft->days * 24) + ($timeLeft->h) + 1 :
            ($timeLeft->days * 24) + ($timeLeft->h));

        return $hoursLeft;
    }

}
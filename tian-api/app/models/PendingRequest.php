<?php

/**
 * Class PendingRequestExistsException
 */
class PendingRequestExistsException extends Exception {
}

/**
 * Class PendingRequestNotFoundException
 */
class PendingRequestNotFoundException extends \Illuminate\Database\Eloquent\ModelNotFoundException {
}

/**
 * Class PendingRequest
 */
class PendingRequest extends \Illuminate\Database\Eloquent\Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['requester_id', 'requested_id', 'type', 'email'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->token = $model->getRandomString();
        });
    }

    /**
     * Returns the relationship between Request and Message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function messages()
    {
        return $this->hasMany('Message', 'pending_request_id', 'id');
    }

    /**
     * Find a pending request by its requester_id.
     *
     * @param $requesterId
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @return \Illuminate\Support\Collection|static
     *
     */
    public static function findByRequesterOrFail($requesterId)
    {
        if (!is_null($model = static::where('requester_id', $requesterId)->first())) {
            return $model;
        }

        throw (new PendingRequestNotFoundException)->setModel(get_called_class());
    }

    /**
     * Find a pending request.
     *
     * @param int $requesterId
     * @param int $requestedId
     * @param string $type
     * @return \Illuminate\Support\Collection|static
     * @throws PendingRequestNotFoundException
     */
    public static function findRequestOrFail($requesterId, $requestedId, $type)
    {
        if (!is_null($model = static::where('requester_id', $requesterId)->where('requested_id', $requestedId)->where('type', $type)->first())) {
            return $model;
        }

        throw (new PendingRequestNotFoundException)->setModel(get_called_class());
    }

    /**
     * Find a pending request by email.
     *
     * @param int $requester
     * @param string $email
     * @param string $type
     * @throws PendingRequestNotFoundException
     * @return \Illuminate\Support\Collection|static
     */
    public static function findByEmailOrFail($requester, $email, $type)
    {
        if (!is_null($model = static::where('requester_id', $requester)->where('email', $email)->where('type', $type)->first())) {
            return $model;
        }

        throw (new PendingRequestNotFoundException)->setModel(get_called_class());
    }

    /**
     * Get Nominations older than $time
     *
     * @param \Carbon\Carbon $time
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function findNominatedBefore($time)
    {
        return static::where('updated_at', '<=', $time)->get();
    }

    /**
     * Save a new requests by id and return the instance.
     *
     * @param int $requester
     * @param int $requested
     * @param string $email
     * @param string $type
     * @return static
     */
    public static function createRequestById($requester, $requested, $email, $type = 'guardian')
    {
        if (!static::requestExists($requester, $requested, $type)) {

            return static::create([
                'requester_id' => $requester,
                'requested_id' => $requested,
                'email' => $email,
                'type' => $type,
            ]);

        }
    }

    /**
     * Save a new requests by email and return the instance.
     *
     * @param int $requester
     * @param string $email
     * @param string $type
     * @return static
     */
    public static function createRequestByEmail($requester, $email, $type = 'guardian')
    {
        if (!static::requestExists($requester, $email, $type, true)) {

            return static::create([
                'requester_id' => $requester,
                'email' => $email,
                'type' => $type,
            ]);

        }
    }

    /**
     * Check the existence of the relationship request.
     *
     * @param int $requester
     * @param int|string $requested
     * @param string $type
     * @param bool $email
     * @return bool
     * @throws PendingRequestExistsException
     */
    public static function requestExists($requester, $requested, $type, $email = false)
    {
        if (!$email && !!static::where('requester_id', $requester)->where('requested_id', $requested)->where('type', $type)->count()) {
            throw new PendingRequestExistsException('Request already exists.');
        }

        else {
            if ($email && !!static::where('requester_id', $requester)->where('email', $requested)->where('type', $type)->count()) {
                throw new PendingRequestExistsException('Request already exists.');
            }
        }

        return false;
    }

    /**
     * Find a pending request by token.
     *
     * @param string $token
     * @throws PendingRequestNotFoundException
     * @return PendingRequest|NULL
     */
    public static function findByToken($token)
    {
        return static::where('token', $token)->first();
    }

    /**
     * Assign the nomination to a different Account
     *
     * @param Account $account
     * @return bool
     */
    public function assignTo($account)
    {
        $this->requested_id = $account->id;
        $this->email = $account->email;

        return $this->save();
    }

    /**
     * Generate a random string.
     *
     * @param int $length
     * @return string
     * @link https://github.com/cartalyst/sentry/blob/v2.1.4/src/Cartalyst/Sentry/Users/Eloquent/User.php
     */
    public function getRandomString($length = 42)
    {
        // We'll check if the user has OpenSSL installed with PHP. If they do
        // we'll use a better method of getting a random string. Otherwise, we'll
        // fallback to a reasonably reliable method.
        if (function_exists('openssl_random_pseudo_bytes')) {
            // We generate twice as many bytes here because we want to ensure we have
            // enough after we base64 encode it to get the length we need because we
            // take out the "/", "+", and "=" characters.
            $bytes = openssl_random_pseudo_bytes($length * 2);

            // We want to stop execution if the key fails because, well, that is bad.
            if ($bytes === false) {
                throw new \RuntimeException('Unable to generate random string.');
            }

            return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}

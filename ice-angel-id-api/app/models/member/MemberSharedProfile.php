<?php

use Illuminate\Database\Eloquent\Model;

class MemberSharedProfile extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_shared_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'contact_id', 'token', 'profile', 'expires_at', 'alert_id',];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['expires_at'];

    /**
     * Serialize the profile field
     *
     * @param $value
     * @return string
     */
    public function setProfileAttribute($value)
    {

        $this->attributes['profile'] =  base64_encode(serialize($value));
    }

    /**
     * Un-serialize the profile field
     *
     * @param $value
     * @return mixed
     */
    public function getProfileAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->expires_at = \Carbon\Carbon::now()->addHours(48);
            $model->token = \Illuminate\Support\Str::random();
        });
    }

    /**
     * Get the public profile url
     *
     * @deprecated
     * @return string
     */
    public function publicProfileUrl()
    {
        $expires = $this->expires_at;
        $timestamp = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expires->toDateTimeString(),  $expires->timezoneName);
        $timestamp = $timestamp->setTimezone('UTC')->toISO8601String();

        return web_app_url('member-public-profile', \App::getLocale(), ['token' => $this->token]) . "?expireDate={$timestamp}";
    }

    /**
     * Find a model by its token or throw an exception.
     *
     * @param  string $token
     * @return \Illuminate\Support\Collection|static
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findByTokenOrFail($token)
    {
        if (!is_null($model = static::where('token', $token)->first())) {
            if (!$model->isExpired()) {
                return $model;
            }

            $model->delete();
        }

        throw (new \Illuminate\Database\Eloquent\ModelNotFoundException)->setModel(get_called_class());
    }

    /**
     * Check if the token is expired
     *
     * @return mixed
     */
    public function isExpired()
    {
        return $this->expires_at->lt(\Carbon\Carbon::now());
    }

    /**
     * Find a model by its alert
     *
     * @param int $alertId
     * @param int $contactId
     * @return mixed
     */
    public static function findByAlert($alertId, $contactId = null)
    {
        $query = static::where('alert_id', $alertId);
        if ( ! is_null($contactId)) {
            $query->where('contact_id', $contactId);
        }

        return $query->first();
    }

    /**
     * Get the personal information as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getKey(),
            'member_id' => $this->member_id,
            'contact_id' => $this->contact_id,
            'token' => $this->token,
            'profile' => $this->profile,
            'expires_at' => (string)$this->expires_at,
        ];
    }
}
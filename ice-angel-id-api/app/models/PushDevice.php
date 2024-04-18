<?php

use Illuminate\Database\Eloquent\Model;

class PushDevice extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'push_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id', 'device_id', 'token', 'type', 'onesignal_id', 'jpush_id'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (PushDevice $device) {

            if ($device->isDirty('account_id') || !$device->exists) {
                Event::fire('account.push-notification-device.registered', [$device->account, $device]);
            }

        });
    }

    /**
     * The owner of the device.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('Account', 'account_id', 'id');
    }

    /**
     * The registered device receiveing push notifications
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo('Device', 'device_id', 'id');
    }

    /**
     * Check if the token is valid.
     *
     * @param $token
     * @param $type
     * @return bool
     */
    public static function checkToken($token, $type)
    {
        if ($type == 'ios') {
            return (ctype_xdigit($token) && 64 == strlen($token));
        }
        elseif ($type == 'android') {

            return (bool)preg_match('/^[0-9a-zA-Z\-\_\:]+$/i', $token) || empty($token);
        }

        return false;
    }

    /**
     * Get device by token
     *
     * @param string $tokens
     * @return \Illuminate\Support\Collection|static|null
     */
    public static function findByTokens($tokens)
    {
        return static::whereIn('token', $tokens)->get();
    }

    /**
     * Delete all unallocated items for this user
     *
     * @param string $tokens
     * @return \Illuminate\Support\Collection|static|null
     */
    public static function deleteUnallocated($accountId)
    {
        DB::table('push_devices')->where('account_id', $accountId)
                                 ->where('token', null)
                                 ->where('onesignal_id', null)
                                 ->where('jpush_id', null)
                                 ->where('type', null)
                                 ->delete();
    }

}
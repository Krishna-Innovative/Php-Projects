<?php

use Illuminate\Database\Eloquent\Model;

class Device extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'member_id', 'phone_code', 'phone_number', 'activated',];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(){

        parent::boot();

        static::deleted(function ($model) {
            DB::table('push_devices')->where('device_id', $model->id)->delete();
        });
    }

    /**
     * Member relationship for the device.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('Member', 'member_id', 'id');
    }

    /**
     * Find device by uuid, which must belong to a member
     *
     * @param string $uuid
     */
    public static function findByUuidOrFail($uuid)
    {
        $model = static::where('uuid', $uuid)->first();

        if (!is_null($model) && !is_null($model->member)){
            return $model;
        }

        throw (new \Illuminate\Database\Eloquent\ModelNotFoundException)->setModel(get_called_class());
    }

    /**
     * Check if the device is already registred.
     *
     * @param string $uuid
     *
     * @return bool
     */
    public static function isRegistred($uuid)
    {
        return !is_null($model = static::where('uuid', $uuid)->first());
    }

    /**
     * Activate the device.
     *
     * @return $this
     */
    public function activate()
    {
        $this->activated = 1;
        $this->save();

        return $this;
    }

    /**
     * Delete old sync request.
     *
     * @return boolean
     */    
    public function deleteSyncRequest()
    {
        $message = $this->member->account
                        ->messages()
                        ->where('type', 'sync.request')
                        ->get()
                        ->filter(function ($m) {
                            $payload = unserialize_base64_decode($m->payload);
                            return $payload['uuid'] == $this->uuid;
                        })
                        ->first();

        if ($message) {
            return $message->delete();
        }
        return false;
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'uuid' => $this->uuid,
            'device_id' => $this->id,

            'phone' => [
                'code' => $this->phone_code,
                'number' => $this->phone_number,
            ],

            'member' => [
                'first_name' => $this->member->first_name,
                'last_name' => $this->member->last_name,
                'middle_name' => $this->member->middle_name,
                'email' => $this->member->email,
                'ice_id' => $this->member->ice_id,
                'full_name' => $this->member->fullName(),
                'photo' => $this->member->photo,
                'id' => $this->member->id
            ],

            'status' => (int)$this->activated,
            
            'account_full_name' => $this->member->account->fullName(),
            'is_account_holder' => $this->member->account->id == $this->member->id
        ];
    }
}
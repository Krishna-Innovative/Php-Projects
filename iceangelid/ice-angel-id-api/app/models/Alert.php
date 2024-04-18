<?php

use Illuminate\Database\Eloquent\Model;

class Alert extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alerts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('account_id', 'member_id', 'angel_information', 'location', 'type',);

    /**
     * Returns the relationship between Alert and Member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->BelongsTo('Member', 'member_id', 'id');
    }

    /**
     * Defines the relationship between Alert and AlertToken.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany('AlertToken', 'alert_id');
    }

    /**
     * Set the serialized Angel's information.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setAngelInformationAttribute($value)
    {

        try {

            $this->attributes['angel_information'] = base64_encode(serialize([
                'code' => $value['code'],
                'number' => $value['number'],
            ]));

        } catch (Exception $e) {

            throw new ValidationException('ValidationException', trans('errors.account.code_phone_missing'));

        }

    }

    /**
     * Get the de-serialized Angel's information.
     *
     * @param $value
     * @return mixed|array
     */
    public function getAngelInformationAttribute($value)
    {

        return unserialize_base64_decode($value);

    }

    /**
     * Set the serialized Alert location.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setLocationAttribute($value)
    {

        $this->attributes['location'] = base64_encode(serialize($value));

    }

    /**
     * Get the de-serialized Alert location.
     *
     * @param $value
     * @return mixed|array
     */
    public function getLocationAttribute($value)
    {

        return unserialize_base64_decode($value);

    }

    /**
     * Get the last 48 hours.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLast48Hours($query)
    {

        return $query->where('alerts.created_at', '>', \Carbon\Carbon::now()->subDays(2));

    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $full_name = $this->member->first_name . ' ' . $this->member->last_name;

        if (has_chinese_characters($full_name)){
            $full_name = full_name($this->member->first_name, $this->member->last_name, $this->member->middle_name, null, false, false);
        }

        return [

            'id' => $this->id,

            'type' => $this->type,

            'member' => [

                'first_name' => $this->member->first_name,

                'last_name' => $this->member->last_name,

                'middle_name' => $this->member->middle_name,

                'full_name' => $full_name,

                'email' => $this->member->email,

                'ice_id' => $this->member->ice_id,

                'id' => $this->member->id,

                'photo' => $this->member->photo,

            ],

            'angel' => [

                'code' => $this->angel_information['code'],

                'number' => $this->angel_information['number'],

            ],

            'location' => $this->locationToArray(),

            // 'token' => $this->tokens()->first()->token,

            'created_at' => $this->created_at,

        ];
    }

    /**
     * Get formatted location object
     *
     * @return callable
     */
    protected function locationToArray()
    {
        if (!$this->member->canTrackLocation()) {
            return null;
        }
        
        if ($this->location instanceof Geocoder\Result\Geocoded) {
            return $this->location->toArray();
        }

        return $this->location;
    }

} 

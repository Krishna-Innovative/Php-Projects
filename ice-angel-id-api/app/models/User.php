<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use IceAngel\Support\IDGenerator\IDGenerator;
use IceAngel\Traits\ScorableTrait;

/**
 * Class User Model
 */
class User extends SentryUser
{

    use ScorableTrait;

    protected $excludedAttributes = ['family_score', 'profile_score',];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::setHasher(new Cartalyst\Sentry\Hashing\NativeHasher);

        static::saved(function ($model) {
            $attributes = $model->getDirty();
            unset($attributes['updated_at']);

            $name = get_called_class();

            foreach ($attributes as $attribute => $value) {
                if (!in_array($attribute, $model->excludedAttributes)) {
                    static::$dispatcher->fire("eloquent.attribute.saved.{$attribute}: {$name}", [$model, $model, $attribute]);
                }
            }
        });

        static::creating(function ($model) {
            $model->ice_id = IDGenerator::generate($model);
        });
    }

    /**
     * Check if the user is an account holder.
     */
    public function isAccount()
    {
        return $this->account_id === $this->id;
    }

    /**
     * Set the serialized Phone number.
     *
     * @param $value
     *
     * @throws ValidationException
     */
    public function setPhoneAttribute($value)
    {
        try {

            $this->attributes['phone'] = base64_encode(serialize([
                'code' => $value['code'],
                'number' => $value['number'],
            ]));

        } catch (Exception $e) {

            throw new ValidationException('ValidationException', trans('errors.account.code_phone_missing'));

        }

    }

    /**
     * Get the de-serialized Phone number.
     *
     * @param $value
     *
     * @return mixed|array
     */
    public function getPhoneAttribute($value)
    {
	//      return unserialize_base64_decode($value);

	$phoneData = unserialize_base64_decode($value);

         if(!empty($phoneData)){

                $phonenumber = isset($phoneData['number'])?$phoneData['number']:'';

                //if( preg_match('/\s/', $phonenumber)){
                if(strpos($phonenumber,'+')!== false && strpos($phonenumber,' ')!== false){

                    $numarray = explode(" ", $phonenumber);

                    $phoneData['number'] = $numarray[1];

                }else if(strpos($phonenumber,'+')!== false && strpos($phonenumber,' ')=== false){

                    $phoneData['number'] = null;

                }else if(strpos($phonenumber,'+')=== false){

                    $phoneData['number'] = $phonenumber;
                }
            }

             return $phoneData;
    }

    /**
     * Set and format the birth date.
     *
     * @param $value
     *
     * @throws ValidationException
     */
    public function setBirthDateAttribute($value)
    {
        try {

		if($value['year'] == null || $value['month'] == null || $value['day'] == null){
                	$this->attributes['birth_date'] = '0000-00-00 00:00:00';
		}else{
			$this->attributes['birth_date'] = \Carbon\Carbon::createFromDate($value['year'], $value['month'], $value['day']);
		}

        } catch (Exception $e) {

            throw new ValidationException('ValidationException', $e->getMessage());

        }

    }

    /**
     * Get un-formatted birth date.
     *
     * @param $value
     *
     * @return mixed|array
     */
    public function getBirthDateAttribute($value)
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);

        // In case of empty birthdate
        if ($date->year == -1) {
            return ['year' => 0,'month' => 0,'day' => 0]; 

	    //(object)[];
        }

        return [
            'year' => $date->year,
            'month' => $date->month,
            'day' => $date->day,
        ];

    }

    /**
     * Set and serialize the Questions
     *
     * @param $value
     *
     * @throws ValidationException
     */
    public function setQuestionsAttribute($value)
    {
        try {

            $this->attributes['questions'] = base64_encode(serialize($value));

        } catch (Exception $e) {

            throw new ValidationException('ValidationException', $e->getMessage());

        }

    }

    /**
     * Get un-serialized Questions.
     *
     * @param $value
     *
     * @return mixed|array
     */
    public function getQuestionsAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * Find member by his ICE Angel id.
     *
     * @param $iceId
     */
    public static function findByIceId($iceId)
    {
        // Remove any white space
        $iceId = str_replace(' ', '', $iceId);

        if (!is_null($model = static::where('ice_id', $iceId)->first())) {
            return $model;
        }

        throw (new \Illuminate\Database\Eloquent\ModelNotFoundException)->setModel(get_called_class());
    }

    /**
     * The user's event history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany('Watchdog', 'user_id', 'id');
    }

    /**
     * Present the user's full name
     *
     * @param string|null $language
     *
     * @return string
     */
    public function fullName($language = null)
    {
        // Return email address in case user did not set her first and last name
        if (!$this->first_name && !$this->last_name) {
            return $this->email;
        }

        if (has_chinese_characters($this->first_name) || has_chinese_characters($this->last_name)) {
            return sprintf('%s%s%s', $this->last_name, $this->first_name, $this->middle_name);
        }

        return str_replace('  ', ' ', sprintf('%s %s %s', $this->first_name, $this->middle_name, $this->last_name));
    }

    /**
     * @return bool
     */
    private function isChina()
    {
        if (!is_null($country = Country::find($this->nationality))) {
            return $country->iso == 'CN';
        }

        return false;
    }
} 

<?php

class MemberPersonal extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_personal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'location_track', 'secondary_email', 'marital_status', 'address', 'passports',
        'social_securities', 'home_phone', 'workplace_phone', 'workplace_address',];

    /**
     * @var string
     */
    protected $collectionPath = 'personal';

    /**
     * Serialize the address
     *
     * @param $value
     * @return string
     */
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the address
     *
     * @param $value
     * @return mixed
     */
    public function getAddressAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * Serialize the passports field
     *
     * @param $value
     * @return string
     */
    public function setPassportsAttribute($value)
    {
        $this->attributes['passports'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the passports field
     *
     * @param $value
     * @return mixed
     */
    public function getPassportsAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * Serialize the social securities field
     *
     * @param $value
     * @return string
     */
    public function setSocialSecuritiesAttribute($value)
    {
        $this->attributes['social_securities'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the social securities field
     *
     * @param $value
     * @return mixed
     */
    public function getSocialSecuritiesAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

    /**
     * Serialize the home phone field
     *
     * @param $value
     * @return string
     */
    public function setHomePhoneAttribute($value)
    {
        $this->attributes['home_phone'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the home phone field
     *
     * @param $value
     * @return mixed
     */
    public function getHomePhoneAttribute($value)
    {
        //return unserialize_base64_decode($value);

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

            return  $phoneData;
    }

    /**
     * Serialize the workplace phone field
     *
     * @param $value
     * @return string
     */
    public function setWorkplacePhoneAttribute($value)
    {
        $this->attributes['workplace_phone'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the workplace phone field
     *
     * @param $value
     * @return mixed
     */
    public function getWorkplacePhoneAttribute($value)
    {
        //return unserialize_base64_decode($value);

	 $phoneData =  unserialize_base64_decode($value);

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

            return  $phoneData;
    }
}

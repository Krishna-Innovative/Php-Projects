<?php

class MemberDoctor extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_doctors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'first_name', 'last_name', 'phone', 'specialty', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.doctors';

    /**
     * Serialize the phone field
     *
     * @param $value
     * @return string
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the phone field
     *
     * @param $value
     * @return mixed
     */
    public function getPhoneAttribute($value)
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

             return $phoneData;
    }

}

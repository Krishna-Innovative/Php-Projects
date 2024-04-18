<?php

class MemberInsurance extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_insurances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'insurance_type', 'number', 'company_name', 'plan_type', 'company_phone', 'expiry_date', 'notes','document',];

    /**
     * @var string
     */
    protected $collectionPath = 'insurances';

    /**
     * Serialize the company phone
     *
     * @param $value
     * @return string
     */
    public function setCompanyPhoneAttribute($value)
    {
        $this->attributes['company_phone'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the company phone
     *
     * @param $value
     * @return mixed
     */
    public function getCompanyPhoneAttribute($value)
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

    /**
     * Set and format the expiry date.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setExpiryDateAttribute($value)
    {
        $this->saveDate('expiry_date', $value);
    }

    /**
     * Get un-formatted expiry date.
     *
     * @param $value
     * @return mixed|array
     */
    public function getExpiryDateAttribute($value)
    {
        return $this->iCEAngelFormattedDate($value);
    }

}

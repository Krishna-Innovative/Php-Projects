<?php

class MemberHospitalRecord extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_hospital_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'date', 'category', 'practitioner', 'file', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.hospital_records';

    /**
     * Set and format the date.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setDateAttribute($value)
    {
        $this->saveDate('date', $value);
    }

    /**
     * Get un-formatted date.
     *
     * @param $value
     * @return mixed|array
     */
    public function getDateAttribute($value)
    {
        return $this->iCEAngelFormattedDate($value);
    }

    /**
     * Serialize the Practitioner field
     *
     * @param $value
     * @return string
     */
    public function setPractitionerAttribute($value)
    {
        $this->attributes['practitioner'] = base64_encode(serialize($value));
    }

    /**
     * Un-serialize the Practitioner field
     *
     * @param $value
     * @return mixed
     */
    public function getPractitionerAttribute($value)
    {
        return unserialize_base64_decode($value);
    }

}
<?php

class MemberMedicalCondition extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_medical_conditions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'name', 'status', 'from', 'to', 'notes','document',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.medical_conditions';

    /**
     * Set and format the date.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setFromAttribute($value)
    {
        $this->saveDate('from', $value);
    }

    /**
     * Get un-formatted date.
     *
     * @param $value
     * @return mixed|array
     */
    public function getFromAttribute($value)
    {
        return $this->iCEAngelFormattedDate($value);
    }

    /**
     * Set and format the date.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setToAttribute($value)
    {
        $this->saveDate('to', $value);
    }

    /**
     * Get un-formatted date.
     *
     * @param $value
     * @return mixed|array
     */
    public function getToAttribute($value)
    {
        return $this->iCEAngelFormattedDate($value);
    }

}
<?php

class MemberMedication extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_medications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'name', 'status', 'dosage', 'dosage_unit', 'frequency', 'frequency_unit', 'purpose', 'from', 'to', 'notes','document',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.medications';

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
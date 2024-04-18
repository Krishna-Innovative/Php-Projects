<?php

class MemberSurgery extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_surgeries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'type', 'date', 'reason', 'notes','document',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.surgical_history';

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
}
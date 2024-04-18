<?php

class MemberLivingWillRecord extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_living_will_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'date', 'document', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'records.living_will';

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
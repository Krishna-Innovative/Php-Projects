<?php

class MemberImmunization extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_immunizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'name', 'series', 'date', 'notes','pname','mfname','lotnumber','srnumber','fullname','qrcode','document','result','scanned','public_key','info'];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.immunizations';

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
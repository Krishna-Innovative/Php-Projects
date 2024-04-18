<?php

class MemberCovid extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_covids';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'pcategory', 'pname','mfname','lotnumber','srnumber','fullname','result','document','notes','coviddate','qrcode','public_key','scanned'];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.covid_reports';

    /**
     * Set and format the date.
     *
     * @param $value
     * @throws ValidationException
     */
    public function setCoviddateAttribute($value)
    {
        $this->saveDate('coviddate', $value);
    }
    /**
     * Get un-formatted date.
     *
     * @param $value
     * @return mixed|array
     */
    public function getCoviddateAttribute($value)
    {
        return $this->iCEAngelFormattedDate($value);
    }

}
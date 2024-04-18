<?php

class MemberAllergy extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_allergies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'name', 'reaction', 'severity', 'notes','document',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.allergies';

}
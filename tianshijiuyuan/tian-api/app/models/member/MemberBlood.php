<?php

class MemberBlood extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_blood';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'blood_type', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.blood';

}
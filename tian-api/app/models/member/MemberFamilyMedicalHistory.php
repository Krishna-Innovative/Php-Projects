<?php

class MemberFamilyMedicalHistory extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_family_medical_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'type', 'relationship', 'severity', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.family_medical_history';
}
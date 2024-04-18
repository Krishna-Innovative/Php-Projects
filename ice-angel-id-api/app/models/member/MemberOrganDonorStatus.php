<?php

class MemberOrganDonorStatus extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_organ_donor_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'status', 'condition', 'card', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'medical.organ_donor';
}
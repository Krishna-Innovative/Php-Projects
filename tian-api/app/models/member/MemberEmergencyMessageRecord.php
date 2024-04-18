<?php

class MemberEmergencyMessageRecord extends AdditionalInformationBaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_emergency_message_records';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['member_id', 'file', 'notes',];

    /**
     * @var string
     */
    protected $collectionPath = 'records.emergency_messages';
}
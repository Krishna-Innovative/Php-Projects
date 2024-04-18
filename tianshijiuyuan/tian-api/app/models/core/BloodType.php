<?php 

class BloodType extends BaseModel {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blood_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type',];
} 
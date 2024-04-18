<?php

/**
 * Class AddMemberValidator
 */
class AddMemberValidator extends BaseValidator
{
    /**
     * @var array
     */
    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'birth_date' => 'required',
        'gender' => 'required',
        'nationality' => 'required',
        'phone' => 'required',
        //'email' => 'email|unique:users',
    ];
}

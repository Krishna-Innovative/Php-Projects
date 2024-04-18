<?php

class UpdatePasswordValidator extends BaseValidator
{

    /**
     * @var array
     */
    protected $rules = [
        'password' => 'required',
        'new_password' => 'required|min:4|max:12|confirmed'
    ];

} 
<?php

class UpdateEmailValidator extends BaseValidator {

    /**
     * @var array
     */
    protected $rules = [
        'email' => 'required|email|unique:users',
    ];

}

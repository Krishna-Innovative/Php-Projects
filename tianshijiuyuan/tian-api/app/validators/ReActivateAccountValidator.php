<?php

class ReActivateAccountValidator extends BaseValidator {

    /**
     * @var array
     */
    protected $rules = [
        'email' => 'required|email',
    ];
}
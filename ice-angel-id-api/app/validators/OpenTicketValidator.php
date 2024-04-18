<?php

class OpenTicketValidator extends BaseValidator
{
    /**
     * @var array
     */
    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'email|required',
        'subject' => 'required',
        'message' => 'required',
    ];
} 
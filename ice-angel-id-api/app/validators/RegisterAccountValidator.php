<?php

/**
 * Class RegisterAccountValidator
 */
class RegisterAccountValidator extends BaseValidator
{
    /**
     * @var array
     */
    protected $rules = [
        //'email' => 'required|email|unique:users',
        'password' => 'required|sometimes',
        // 'first_name' => 'required',
        // 'last_name' => 'required',
        // 'emergency_channels' => 'required',
        'birth_date' => 'required',
        // 'gender' => 'required',
        // 'nationality' => 'required',
        // 'phone' => 'required',
        // 'security_question_1' => 'required',
        // 'security_answer_1' => 'required',
        // 'security_question_2' => 'required',
        // 'security_answer_2' => 'required',
    ];
}

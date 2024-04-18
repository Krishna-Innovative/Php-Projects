<?php

class RegisterDeviceTokenValidator extends BaseValidator {

    /**
     * @var array
     */
    protected $messages = [
        'token' => 'Invalid device token.',
        'jpush_id' => 'Invalid jpush_id field'
    ];

    /**
     * @var array
     */
    protected $rules = [
        'token' => 'required|token',
        'type' => 'required|in:ios,android',
        'onesignal_id' => 'required',
        // 'jpush_id' => 'required_if:type,android
    ];

    /**
     * The class constructor.
     */
    function __construct()
    {
        $this->tokenValidationRule();
    }

    /**
     * Define a custom rule that validates a given token.
     */
    private function tokenValidationRule()
    {
        Validator::extend('token', function ($attribute, $value, $parameters) {
            return PushDevice::checkToken($value, Input::get('type', 'ios'));
        });

    }
}
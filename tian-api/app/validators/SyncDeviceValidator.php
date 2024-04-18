<?php

class SyncDeviceValidator extends BaseValidator {
    /**
     * @var array
     */
    protected $messages = [
        'unique' => 'Error: device ID (registered or empty)',
        'required' => 'Error: notification server (incomplete)'
    ];

    /**
     * @var array
     */
    protected $rules = [
        'uuid' => 'required|unique:devices',
        'member_id' => 'required',
        'phone_code' => 'required',
        'phone_number' => 'required',
    ];

} 
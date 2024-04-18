<?php

class UpdateSyncedDeviceValidator extends BaseValidator {
    /**
     * @var array
     */
    protected $messages = [
        'unique' => trans('errors.sync.device_registered')
    ];

    /**
     * @var array
     */
    protected $rules = [
        'new_uuid' => 'required',
    ];

} 
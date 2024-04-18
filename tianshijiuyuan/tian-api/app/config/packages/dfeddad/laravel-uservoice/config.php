<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | UserVoice API
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for UserVoice API.
    */

    'subdomain' => getenv('USERVOICE_SUBDOMAIN'),

    'apiKey' => getenv('USERVOICE_API_KEY'),

    'apiSecret' => getenv('USERVOICE_API_SECRET'),

);

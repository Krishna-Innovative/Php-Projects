<?php

$app_url = getenv("APP_URL");

return array(

    'home' => $app_url,

    'login' => $app_url . '/#/login:query',

    'register' => $app_url . '/#/registration/register:query',

    'activate' => $app_url . '/#/account/active?activated=:status',

    'shared_profile' => $app_url . '/#/members/public/:token',

    'member-public-profile' => $app_url . '/#/members/public/:token',

    'reset_password' => $app_url . '/#/password/reset/:token',

    'trigger_alert' => $app_url . '/#/trigger-alert/iceid:query',

    'covid_alert' => $app_url . '/#/covid/public-key/:token',

    'vaccine_alert' => $app_url . '/#/immunization/public-key/:token',

    'member-profile' => $app_url . '/#/account/member/:memberId:query',

    'message-center' => $app_url . '/#/account/messages',

    'account-settings' => $app_url . '/#/account/settings',
    
    'forgot-password' => $app_url . '/#/forget-password/email',

    'about' => $app_url . '/#/aboutus',

    'learn-more' => $app_url,

);

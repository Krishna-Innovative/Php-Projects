<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Error Messages Language Lines
    |--------------------------------------------------------------------------
    */


    'auth' => array(

        'ip_blocked' => 'Sorry, our registration system is currently overloaded. Please try again after one hour',

        'user_already_activated' => 'Your email address is already verified',

        'user_not_found' => 'Incorrect username or password, please try again',

        'user_suspended' => 'Your account is suspended for :time minutes',

        'user_banned' => 'Your account is blocked',

        'wrong_ice_id' => 'Incorrect username or password, please try again',

        'login_required' => 'Email field is required',

        'password_required' => 'Password field is required',

        'wrong_password' => 'Incorrect username or password, please try again',

        'user_not_activated' => 'Your email address is not verified, please check your inbox or request a new activation email',

        'jwt_invalid' => 'Invalid user token',

        'jwt_missing' => 'User token is missing',

    ),
    'account' => array(

        'activation_sent' => 'An activation link was sent to your email address',

        'not_found' => 'Account was not found',

        'has_members' => 'An account cannot be deleted with a linked dependent member. First remove the dependent member(s)',

        'has_member' => ' members',

        'has_fins' => ' friends in need',

        'has_guardian' => ' guardians',

        'has_ecps' => ' emergency contact persons',

        'pre_msg' => 'First remove your linked',

        'has_fin' => 'A member cannot be deleted with a linked friend in need. First remove the friend(s) in need',

        'has_guardians' => 'A member cannot be deleted with a linked guardian. First remove the guardian(s)',

        'settings' => array(

            'wrong_password' => 'Incorrect password',

            'password_updated' => 'Password successfully updated',

            'email_updated' => 'To complete the process, please confirm your new email address by clicking on the verification link we sent to {email}',

        ),
        'password_match' => 'Password match',

        'password_mismatch' => 'Incorrect password',

        'not_partner' => 'Account is not a Partner',

        'code_phone_missing' => 'Area code or phone number are missing',

    ),
    'member' => array(

        'not_found' => 'Member was not found',

        'noecp' => 'There is no emergency contact person linked to this member',

        'has_contacts' => 'A member cannot be deleted with a linked emergency contact person. First remove the emergency contact person(s)',

        'transfer_is_account' => 'Member\'s email address is already registered as an account holder',

        'transfer_email_in_use' => 'Email address is already in use. Please use a different email address',

    ),
    'covid' => array(
        'wrong_category' => 'Invalid QR code',

        'wrong_serialnumber' => 'This serial number has already been registered',
    ),
    'reminders' => array(

        'incorrect_security_question' => 'Your security answer is incorrect. Please try again',

        'reset_success' => 'Your password has been successfully reset!',

        'invalid_reset_code' => 'Invalid reset code. Please try to reset your password again',

        'system_error' => 'Oops, something went wrong. Please try again, or contact us for assistance',

    ),
    'contact' => array(

        'not_allowed_operation' => 'Operation not allowed',

        'member_not_found' => 'Member not found',

        'reached_max_allowed_contacts' => 'A member can have a maximum of two emergency contact persons',

        'requested_account_identifier_missing' => 'Missing account ID and email address',

        'contact_exists' => 'The requested account holder is already your emergency contact person',

        'request_exists' => 'A request has already been sent to this account holder',

        'requested_account_is_member' => 'This email address is registered to a dependant iCE Angel - ID™ member. Dependent members cannot be emergency contact persons - please nominate someone else',

        'requested_account_not_found' => 'Requested account was not found',

        'requester_not_found' => 'Requester member was not found',

        'request_not_found' => 'Request not found',

    ),
    'share' => array(

        'forbidden' => 'You do not have permission to access this member profile',

    ),
    'support' => array(

        'open_ticket_success' => 'Thank you for your enquiry to iCE Angel - ID™. We will respond as soon as possible',

        'open_ticket_error' => 'Oops, something went wrong. Please try submit your enquiry again, or contact us for assistance',

    ),
    'sync' => array(

        'device_not_found' => 'A panic button has already been registered to this device ID. Try uninstall and reinstall the app, or contact us for help',

        'device_incomplete' => 'Cannot retrieve device ID information. Please try again',

        'member_id_required' => 'iCE Angel - ID™ number is required',

        'device_blocked' => 'Your sync function has been blocked due to five failed attempts. Please try again after one hour',

        'invalid_account_authentication' => 'The password and iCE Angel - ID™ number do not match up. Please try again',

        'invalid_account_email_authentication' => 'The email address and iCE Angel - ID™ number do not match up. Please try again',

        'device_registered' => 'A panic button has already been registered to this device ID. Try uninstall and reinstall the app, or contact us for help',

        'sync_exceed_limit' => 'Maximum 3 panic buttons per member allowed',

        'partner_permium_exception' => 'Request :account to upgrade to a premium subscription to setup panic button',

    ),
    'guardian' => array(

        'reached_max_allowed_guardians' => 'An account can have a maximum of two guardians',

        'requested_account_not_allowed' => 'Cannot send request to this account holder',

        'requested_account_identifier_missing' => 'Missing Account ID and Email Address',

        'requested_account_exists' => 'The requested account holder is already your guardian',

        'requested_account_is_member' => 'This email address is registered to a dependant iCE Angel - ID™ member. Dependent members cannot be guardians - please nominate someone else',

        'requested_account_not_found' => 'Requested account was not found',

        'request_exists' => 'A request has already been sent to this account holder',

        'not_allowed_operation' => 'Operation not allowed',

        'requester_not_found' => 'Requester account was not found',

        'request_not_found' => 'Request not found',

    ),
    'system_error' => 'Oops, something went wrong. Please try again, or contact us for assistance',

    'file' => array(

        'no_file_uploaded' => 'No file has been uploaded',

    ),
    'payment' => array(

        'coupon_not_found' => 'Invalid coupon code ;(',

        'subcription_error' => 'Payment failed ;( Please try again...',

    ),
);

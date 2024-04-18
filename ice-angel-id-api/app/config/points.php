<?php

/*
|--------------------------------------------------------------------------
| Points System
|--------------------------------------------------------------------------
|
| Below you will find the possible scores the account can redeem.
|
*/

return [

    // Successful account verification
    'account.activated' => [
        'title' => 'Successful account registration',
        'familyScore' => 500,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Successful login
    'account.login' => [
        'title' => 'Login',
        'familyScore' => 20,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Reset password
    'account.password.reset' => [
        'title' => 'Successful reset password',
        'familyScore' => 20,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Contact us
    'account.static.contactus' => [
        'title' => 'Contact us',
        'familyScore' => 20,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Terms & conditions
    'account.static.terms' => [
        'title' => 'Terms & conditions',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Privacy policy
    'account.static.privacy' => [
        'title' => 'Privacy policy',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Privacy policy
    'account.static.faq' => [
        'title' => 'FAQ',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Help
    'account.static.help' => [
        'title' => 'Help',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Sync device
    'device.sync.accepted' => [
        'title' => 'Device synced',
        'familyScore' => 200,
        'profileScore' => 15,
        'isAccount' => false,
    ],

    // Update attributes
    'attribute.updated' => [
        'title' => 'Attribute updated',
        'familyScore' => 10,
        'profileScore' => 0.5,
        'isAccount' => false,
    ],

    // Print Member Card
    'member.share.download-member-id' => [
        'title' => 'Print ID',
        'familyScore' => 10,
        'profileScore' => 20,
        'isAccount' => false,
    ],

    // Download Member Profile
    'member.share.download-member-profile' => [
        'title' => 'Share Profile - PDF',
        'familyScore' => 50,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // Email Member Profile
    'member.share.email' => [
        'title' => 'Share Profile - Email',
        'familyScore' => 50,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // Accept friend in need request
    'account.accept.friend-in-need' => [
        'title' => 'Accept FIN',
        'familyScore' => 100,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Add first ECP
    'member.add.contact-1' => [
        'title' => 'Add ECP 1',
        'familyScore' => 50,
        'profileScore' => 15,
        'isAccount' => false,
    ],

    // Add second ECP
    'member.add.contact-2' => [
        'title' => 'Add ECP 2',
        'familyScore' => 50,
        'profileScore' => 9,
        'isAccount' => false,
    ],

    // Add Guardian
    'account.add.guardian' => [
        'title' => 'Add GUA',
        'familyScore' => 50,
        'profileScore' => 0,
        'isAccount' => true,
    ],

    // Add Guardian
    'member.contact.update-permissions' => [
        'title' => 'ECP Permission Settings',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // View Member history
    'member.view.history' => [
        'title' => 'View History',
        'familyScore' => 10,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // Send transfer to invitation
    'member.send.transfer-invitation' => [
        'title' => 'Transfer Profile - Send Invitation',
        'familyScore' => 50,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // Member trigger a panic button
    'member.trigger.panic-button' => [
        'title' => 'Trigger panic button',
        'familyScore' => 50,
        'profileScore' => 0,
        'isAccount' => false,
    ],

    // Member trigger a panic button
    'angel.trigger.alert' => [
        'title' => 'Trigger alert by an Angel',
        'familyScore' => 200,
        'profileScore' => 0,
        'isAccount' => false,
    ],

];

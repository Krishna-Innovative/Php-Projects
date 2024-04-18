<?php

return [

    'alert' => [

        'normal' => 'An emergency alert has been triggered for this member',

        'panic' => 'A panic button has been triggered for this member',

    ],

    'account' => [

        'login' => 'Account holder is logged in',

        'activated' => 'Account has been activated',

        'password-updated' => 'Account\'s password was updated',

        'email-updated' => 'Account\'s email address was updated',

        'password' => [

            'reset' => 'Account password reset',
        ],

    ],

    'ecp' => [

        'request' => [

            'member' => ':contact was nominated to be an emergency contact person for this member',

            'contact' => 'You were nominated to be an emergency contact person for :member',

        ],

        'accept' => [

            'member' => ':contact has accepted the emergency contact person nomination for this member',

            'contact' => 'You accepted the emergency contact person nomination for :member',

        ],

        'decline' => [

            'member' => ':contact has declined the emergency contact person nomination for this member',

            'contact' => 'You declined the emergency contact person nomination for :member',

        ],

        'cancel' => [

            'member' => 'The nomination of :contact as the emergency contact person for this member was canceled',

            'contact' => 'The emergency contact person nomination for :member was canceled',

        ],

        'delete' => [

            'member' => ':contact was removed from the emergency contact person list for this member',

            'contact' => 'You were removed from the emergency contact person list for :member',

        ],

    ],

    'guardian' => [

        'request' => [

            'account' => 'You have nominated :guardian to be your guardian',

            'guardian' => ':account nominated you to be their guardian',

        ],

        'accept' => [

            'account' => ':guardian accepted your nomination as your guardian',

            'guardian' => 'You accepted :account\'s nomination as their guardian',

        ],

        'decline' => [

            'account' => ':guardian declined your nomination as your guardian',

            'guardian' => 'You declined :account\'s nomination as their guardian',

        ],

        'cancel' => [

            'account' => 'You cancelled the nomination of :guardian as your guardian',

            'guardian' => ':account has canceled your nomination as their guardian',

        ],

        'delete' => [

            'account' => 'You have removed :guardian as your guardian',

            'guardian' => ':account has removed you as their guardian',

        ],
    ],

    'device' => [

        'synced' => 'New device was synced',

        'unsynced' => 'Device was un-synced',

        'sync' => [

            'accepted' => 'New device was accepted',

            'deleted' => 'Device was un-synced',

            'declined' => 'Device sync was rejected.'

        ],

    ],

    'member' => [

        'share' => [

            'email' => [

                'account' => 'Member has emailed their member profile',

                'contact' => ':contact has emailed the member profile',
            ],

            'download-member-id' => 'Member has downloaded their iCE Angel - ID card',

            'view-profile' => [

                'contact' => ':contact has accessed this member\'s profile',

                'third-party' => 'A third party person has accessed this member\'s profile',

            ],

            'download-member-profile' => 'Member has downloaded their member profile',
        ],

        'attribute' => [

            'updated' => 'Member\'s :attribute was updated',

        ],

    ],

    'friend' => [

        'guardian' => [

            'guardian' => 'You have removed yourself as a guardian for :account',

            'account' => ':guardian has removed themselves as your guardian',

        ],

        'contact' => [

            'contact' => 'You have removed yourself as the emergency contact person for :member',

            'member' => ':contact has removed himself/herself as the emergency contact person for this member',

        ],

    ],
];
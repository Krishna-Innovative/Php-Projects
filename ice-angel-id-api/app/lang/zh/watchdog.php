<?php

return [

    'alert' => [

        'normal' => '此成员急救通知已被触发',

        'panic' => '此成员的紧急按钮已被触发',

    ],

    'account' => [

        'login' => '账户持有人登录成功',

        'activated' => '账户已激活',

        'password-updated' => '账户密码已修改',

        'email-updated' => '账户邮箱地址已更新',

        'password' => [

            'reset' => '账户的密码已更新',
        ],
    ],

    'ecp' => [

        'request' => [

            'member' => ':contact已被邀请成为紧急联系人 ',

            'contact' => '您已邀请:member成为紧急联系人',

        ],

        'accept' => [

            'member' => ':contact已接受紧急联系人的邀请',

            'contact' => '您已经接受了:member的紧急联系人',

        ],

        'decline' => [

            'member' => ':contact已经拒绝紧急联系人申请',

            'contact' => '您已拒绝了:member的紧急联系人申请',

        ],

        'cancel' => [

            'member' => 'contact的紧急联系人申请已被取消',

            'contact' => ':member的紧急联系人已经被取消',

        ],

        'delete' => [

            'member' => ':contact已被从紧急联系人列表中移除',

            'contact' => '您已被从:member的紧急联系人列表中移除',

        ],

    ],

    'guardian' => [

        'request' => [

            'account' => '您已邀请:guardian成为您的监护人',

            'guardian' => ':account邀请您成为监护人',

        ],

        'accept' => [

            'account' => ':guardian已接受您的监护人邀请',

            'guardian' => '您已接受:account的监护人邀请',

        ],

        'decline' => [

            'account' => ':guardian拒绝了您的监护人邀请',

            'guardian' => '您已拒绝:account的监护人邀请',

        ],

        'cancel' => [

            'account' => '您已取消:guardian作为您的监护人',

            'guardian' => ':account已取消您作为监护人',

        ],

        'delete' => [

            'account' => '您已移除:guardian成为您的监护人',

            'guardian' => ':account已取消您的监护人',

        ],
    ],

    'device' => [

        'synced' => '新设备已同步',

        'unsynced' => '设备未同步',

        'sync' => [

            'accepted' => '新设备已接受',

            'deleted' => '设备为同步',

            'declined' => '设备被拒绝.'

        ],

    ],

    'member' => [

        'share' => [

            'email' => [

                'account' => '成员已发送他得资料',

                'contact' => ':contact 已邮件发送成员的资料',
            ],

            'download-member-id' => '成员已经成功下载成员卡',

            'view-profile' => [

                'contact' => '已有 :contact 登录此成员资料',

                'third-party' => '已有其他人登录此成员资料',

            ],

            'download-member-profile' => '成员已经成功下载成员资料',
        ],

        'attribute' => [

            'updated' => ':attribute已更新',

        ],

    ],

    'friend' => [

        'guardian' => [

            'guardian' => '您已不再是:account的监护人',

            'account' => ':guardian已取消作为您的监护人',

        ],

        'contact' => [

            'contact' => '您已不再是:member的紧急联系人',

            'member' => ':contact已从您的紧急联系人列表中移除',

        ],

    ],
];
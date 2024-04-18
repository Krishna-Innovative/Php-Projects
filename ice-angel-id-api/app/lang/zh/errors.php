<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Error Messages Language Lines
    |--------------------------------------------------------------------------
    */


  'auth' => array(

    
        'login_required' => '邮箱必填',

        'password_required' => '密码必填',

        'wrong_password' => '用户名或密码错误，请重试',

        'user_not_found' => '用户名或密码错误，请重试',

        'user_not_activated' => '您的电子邮件地址未验证，请检查您的收件箱或重新发送激活邮件',

        'user_already_activated' => '您的电子邮件地址已验证',

        'user_suspended' => '您的账号已被锁定 :time 分钟.',

        'user_banned' => '您的账号已被禁止.',

        'jwt_invalid' => '用户令牌不正确',

        'jwt_missing' => '用户令牌不存在',

        'wrong_ice_id' => '用户名或密码错误，请重试',

        'ip_blocked' => '抱歉，我们的注册系统正忙。请在一小时后重试',

  ),
  'account' => array(

    'not_found' => '账号不存在',

    'password_mismatch' => '密码错误',

    'password_match' => '密码一致',

    'activation_sent' => '激活链接已经发送至您的新邮箱地址',

    'settings' => array(

      'wrong_password' => '密码错误',

      'password_updated' => '密码修改成功',

      'email_updated' => '我们发送了一封邮件到{email}，请查收并点击邮件中的验证链接',

    ),
    'has_member' => '子账号成员',

    'has_fins' => '需要帮助的朋友',

    'has_guardian' => '监护人',

    'has_ecps' => '紧急联系人',

    'pre_msg' => '请先移除您的',
        
    'has_members' => '该账户已关联子账号，故无法删除，请先删除监护人后再重试',

    'has_fin' => '该账号已关联需要帮助的朋友，故无法删除。请先删除需要帮助的朋友后再重试',

    'has_guardians' => '该账户已关联监护人，故无法删除，请先删除监护人后再重试',

    'not_partner' => '该账号不属于合作伙伴账号',

    'code_phone_missing' => '缺少国际区号或电话号码',

  ),
  'member' => array(

    'not_found' => '会员不存在',

    'noecp' => '该会员没有设置紧急联系人',

    'transfer_is_account' => '该会员的邮箱地址已被另一个账号持有人使用',

    'transfer_email_in_use' => '该邮箱地址已被使用。请重新输入一个不同的邮箱地址 ',

    'has_contacts' => '无法删除链接有紧急联系人的账户，请先移除紧急联系人后再试',

  ),
  'covid' => array(
        'wrong_category' => '无效二维码',

        'wrong_serialnumber' => '此序列号已被注册',
    ),
  'guardian' => array(

    'requested_account_not_allowed' => '无法发送请求给该账号持有人',

    'requested_account_not_found' => '此账号不存在',

    'requested_account_identifier_missing' => '账号和邮箱地址不存在',

    'requested_account_is_member' => '该邮箱已注册为非独立的天使救援™子账号，无法担当监护人。请指定其他人',

    'request_exists' => '请求已发送至该账号持有人',

    'requested_account_exists' => '该账号持有人已被成功添加为您的监护人',

    'reached_max_allowed_guardians' => '一个账号最多可添加两位监护人',

    'request_not_found' => '操作不成功',

    'requester_not_found' => '找不到邀请人的账号',

    'not_allowed_operation' => '该操作不可行',

  ),
  'contact' => array(

    'member_not_found' => '会员不存在',

    'reached_max_allowed_contacts' => '一个账号最多可添加两位紧急联系人',

    'requested_account_identifier_missing' => '账号和邮箱地址不存在',

    'requested_account_is_member' => '该邮箱已注册为非独立的天使救援™子账号，无法担当紧急联系人。请指定其他人',

    'requested_account_not_found' => '此账号不存在',

    'request_exists' => '请求已发送至该账号持有人',

    'contact_exists' => '该账号持有人已被成功添加为您的紧急联系人',

    'request_not_found' => '操作不成功.',

    'requester_not_found' => '找不到邀请的会员',

    'not_allowed_operation' => '该操作不可行',

  ),
  'file' => array(

    'no_file_uploaded' => '没有上传文件',

  ),
  'reminders' => array(

    'incorrect_security_question' => '您的密保问题答案错误，再试一次',

    'reset_success' => '密码重置成功',

    'system_error' => '啊哦，出错了，再试一次吧！或者联系我们',

    'invalid_reset_code' => '验证码无效，请重新设置密码',

  ),
  'support' => array(

    'open_ticket_error' => '啊哦，没成功。请再试一次',

    'open_ticket_success' => '感谢您咨询天使救援™。我们会尽快回复',

  ),
  'sync' => array(

    'member_id_required' => '天使救援™账号是必填项',

    'device_blocked' => '您已输错5次。您设置紧急按钮的请求已被禁止。请在一小时后重试',

    'invalid_account_authentication' => '密码或天使救援™号码错误，请重试',

    'invalid_account_email_authentication' => '邮箱地址或天使救援™号码错误，请重试',

    'device_not_found' => '该序列号的设备已经绑定紧急按钮。请卸载APP后重新安装，或联系我们',

    'device_registered' => '该序列号的设备已经绑定紧急按钮。请卸载APP后重新安装，或联系我们',

    'device_incomplete' => '无法获取该设备的序列号。请重试',

    'sync_exceed_limit' => '每个成员最多只能设置3个紧急按钮',

    'partner_permium_exception' => 'Request :account to upgrade to a premium subscription to setup panic button',

  ),
  'share' => array(

    'forbidden' => '您不能访问该会员的档案',

  ),
  'payment' => array(

    'subcription_error' => '付款失败，请重试……',

    'coupon_not_found' => '无效优惠券代码',

  ),
  'system_error' => '啊哦，出错了，再试一次吧！或者联系我们',

);

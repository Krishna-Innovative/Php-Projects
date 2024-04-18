<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | Message Center Language Lines
    |--------------------------------------------------------------------------
    */
    
  'contact' => array(
    
    'request' => array(
      
      'to_account' => '天使救援™ :member 紧急联系人邀请已成功发送至 :contact',
      
      'to_contact' => '您已受邀成为 :member 的紧急联系人',
      
      'to_self' => '您已经成为 :member 紧急联系人',
    ),
    
    'accept' => array(
      
      'to_account' => '恭喜您, :contact 已经接受 :member 的天使救援™ 紧急联系人的邀请',
      
      'to_contact' => '恭喜, 您现在是 :member 的天使救援™ 紧急联系人',
    ),
    
    'decline' => array(
      
      'to_account' => ':contact 已经拒绝 :member 的天使救援™ 紧急联系人邀请 ',
      
      'to_contact' => '您已经拒绝  :member 的天使救援™ 紧急联系人邀请',
    ),
    
    'cancel' => array(
      
      'to_account' => '您已经取消了邀请:contact 成为:member 的天使救援™紧急联系人的请求',
      
      'to_contact' => ':member 已取消了邀请您成为其天使救援™紧急联系人的请求',
    ),
    
    'delete' => array(
      
      'to_account' => '您已将:member 从 :contact 的天使救援™ 紧急联系人名单中删除邀请',
      
      'to_contact' => '您已被移出:member 天使救援™紧急联系人的名单',
    ),
  ),
  
  'guardian' => array(
    
    'request' => array(
      
      'to_account' => '您邀请:guardian成为您的天使救援™账号监护人的请求已发送',
      
      'to_guardian' => '您已经受邀成为 :account 的天使救援™监护人',
    ),
    
    'accept' => array(
      
      'to_account' => '恭喜, :guardian 已经接受您的天使救援™监护人邀请',
      
      'to_guardian' => '恭喜, 您已成为 :account 的天使救援™监护人',
    ),
    
    'decline' => array(
      
      'to_account' => ':guardian 已经拒绝您的天使救援™监护人的请求',
      
      'to_guardian' => '您已拒绝了 :account 的天使救援™监护人的请求',
    ),
    
    'cancel' => array(
      
      'to_account' => '您已经取消邀请:guardian 成为您天使救援™监护人的请求。',
      
      'to_guardian' => ':account 已取消邀请您成为其天使救援™监护人的请求',
    ),
    
    'delete' => array(
      
      'to_account' => '您已经将:guardian 从您的天使救援™监护人名单中删除',
      
      'to_guardian' => ' :account 已经将您从其天使救援™监护人名单中删除',
    ),
  ),
  
  'sync' => array(
    
    'request' => ':member 要求将其紧急按钮和电话号码:phone进行绑定',
    
    'accept' => ':member的紧急按钮已成功绑定电话号码:phone',
    
    'decline' => ':member的紧急按钮已经与手机号码 :phone解除绑定',
  ),
  
  'push_notifications' => array(
    
    'alert' => array(
      
      'normal' => ':member的急救警报已发送',
      
      'panic' => ':member的紧急按钮已触动',
    ),
    
    'account' => array(
      
      'suspended' => '由于账户出现可疑操作，为保证安全，我们已暂停您的账户',
      
      'banned' => '由于账户出现可疑操作，为保证安全，我们已暂停您的账户',
      
      'reset-password' => '您已成功重置天使救援™密码',
    ),
    
    'contact' => array(
      
      'request' =>       array(
        
        'account' => ' :member 的天使救援™紧急联系人邀请已成功发送至 :contact',
        
        'contact' => ' :member 已邀请您成为其紧急联系人',
      ),
      
      'accept' =>       array(
        
        'account' => '恭喜，:contact已经接受邀请，成为:member的天使救援™紧急联系人',
        
        'contact' => '恭喜，您现在成为:member 的天使救援™ 紧急联系人',
      ),
      
      'decline' =>       array(
        
        'account' => ':contact 已经拒绝了成为 :member 的天使救援™ 紧急联系人的请求',
        
        'contact' => '您已经拒绝 :member 的天使救援™ 紧急联系人的邀请',
      ),
      
      'cancel' =>       array(
        
        'account' => '您已经取消了邀请:contact 成为:member 的天使救援™紧急联系人的请求',
        
        'contact' => ':member 已经取消邀请您成为其天使救援™紧急联系人的请求',
      ),
      
      'delete' =>       array(
        
        'account' => '您已将:contact 从 :member 的天使救援™ 紧急联系人 名单中删除',
        
        'contact' => '您已被移出:member 天使救援™紧急联系人的名单',
      ),
    ),
    
    'guardian' => array(
      
      'request' =>       array(
        
        'account' => '您的天使救援™监护人邀请已成功发送至:guardian',
        
        'guardian' => '您已经受邀成为 :account 的天使救援™监护人',
      ),
      
      'accept' =>       array(
        
        'account' => '恭喜, :guardian 已经接受您的天使救援™监护人邀请',
        
        'guardian' => '恭喜, 您已成为 :account 的天使救援™监护人',
      ),
      
      'decline' =>       array(
        
        'account' => ':guardian 已经拒绝您的天使救援™监护人邀请',
        
        'guardian' => '您已拒绝了 :account 的天使救援™监护人邀请',
      ),
      
      'cancel' =>       array(
        
        'account' => '您已取消了邀请 :guardian 成为您的天使救援™监护人的请求',
        
        'guardian' => '您发送给:account 的天使救援™监护人邀请已被取消',
      ),
      
      'delete' =>       array(
        
        'account' => '您已经将:guardian 从您天使救援™监护人名单中删除',
        
        'guardian' => '您已被从 :account 的天使救援™监护人名单中删除',
      ),
    ),
    
    'friends' => array(
      
      'delete_contact' =>       array(
        
        'to_contact' => '您已经将自己从:member 的天使救援™紧急联系人名单中删除',
        
        'to_account' => ':contact已经将:member从需要帮助的朋友名单中删除',
      ),
      
      'delete_guardian' =>       array(
        
        'to_guardian' => '您已经将自己从:account 的天使救援™监护人名单中删除',
        
        'to_account' => ':guardian 已经将自己从您的天使救援™监护人名单中删除',
      ),
    ),
    
    'member' => array(
      
      'delete' =>       array(
        
        'account' => '您已经将子账号 :member从您的天使救援™账号中删除',
        
        'contact' => ':account删除已删除了您的天使救援™账户中的需要帮助的朋友 :member',
      ),
      
      'profile' =>       array(
        
        'viewed' => ' 请注意，由于紧急警报已触发，:member的天使救援™急救资料已经被:contact查看。 ',
      ),
    ),
  ),
  
  'twitter_notifications' => array(
    
    'alert' => array(
      
      'normal' => ':member_last_name :member_first_name 的急救警报已触发',
      
      'panic' => ':member_last_name :member_first_name的紧急按钮已触发',
    ),
  ),
  
  'messenger_notifications' => array(

    'alert' => array(

      'normal' => '紧急通知已发送给 :member_full_name',

      'panic' => '紧急按钮被 :member_full_name 使用',

      'button' => 'View Website',
    ),

    'help' => 'Welcome to iCE Angel - ID™, an internet based medical alert and emergency identification platform that offers a comprehensive global service including a personal panic button, angel alert, and secure emergency information access.',

    'instructions' => "Thanks for contacting us, we try to respond to all messages within 24hrs. You can also help us to help you by selecting one of the options below:",
        
    'link_confirmation' => 'By connecting your account, you will receive alert notifications via Messenger',

    'open_website' => 'Open Website',

    'read_faq' => 'Read FAQ',

    'something_else' => 'Something Else',

    'confirmation' => "iCE Angel - ID™  ❤ \nWelcome to our community. You will now receive automated alerts through Messenger"
  ),

  'friends' => array(
    
    'delete_contact' => array(
      
      'to_contact' => '您已经将自己从:member的紧急联系人名单中删除',
      
      'to_account' => ':contact 已将自己从:member的紧急联系人名单中删除',
    ),
    
    'delete_guardian' => array(
      
      'to_guardian' => '您已经成功移除作为的:account天使救援™监护人',
      
      'to_account' => ':guardian已经将自己从您的天使救援™监护人名单中删除',
    ),
  ),
  
  'auth' => array(
    
    'account' => array(
      
      'suspended' => '由于您的账户出现可疑易操作，为保障安全，我们已暂停了您的账户',
      
      'banned' => '由于账户出现可疑操作，为保证安全，我们已暂停您的账户',
      
      'reset-password' => '已成功重置密码',

      'updated-password' => '密码更新成功',
    ),
  ),
  
  'member' => array(
    
    'delete' => array(
      
      'to_account' => '您已将子账号:member的信息从您的账号中删除',
      
      'to_contact' => ':account已将 :member从需要帮助的朋友名单中删除',
    ),
    
    'profile' => array(
      
      'viewed' => '请注意，由于紧急警报已触发，:member的天使救援™急救资料已经被:contact查看。 ',
    ),
    
    'transfer' => array(
      
      'success' => '已成功向 :name发送邀请',
    ),
  ),
  
  'account' => array(
    
    'members-updated' => '(:members)的天使救援™会员信息已被修改',
    
    'questions-updated' => '您的账号密保问题已修改成功',
    
    'email-updated' => '您账号的邮箱地址已更新为:email',

    'email-updated-message' => '账户的邮箱地址已更新',

  ),
);

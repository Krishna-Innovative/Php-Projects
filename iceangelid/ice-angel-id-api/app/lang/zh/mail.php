<?php

return array(

  'subjects' => array(

        'contact-request' => '🔎👉 天使救援™ | 紧急联系人邀请',

        'guardian-request' => '🔎👉 天使救援™ | 监护人邀请',

        'account-activation' => '🔎👉 天使救援™ | 激活账户',

        'account-invitation' => '🔎👉 天使救援™ | 账户邀请',

        'password-reset' => '🔎👉 天使救援™ | 密码重置',

        'password-updated' => '🔎👉 天使救援™ | 更新密码',

        'emergency-alert' => '🔎👉 天使救援™ | 急救通知',

        'panic-alert' => '🔎👉 天使救援™ | 个人紧急救援',

        'email-verification' => '🔎👉 天使救援™ | 验证邮箱地址',

        'email-updated' => '🔎👉 天使救援 | 邮箱地址已更新',

        'share-profile' => '🔎👉 天使救援™ | 用户资料',

        'account-suspended' => '🔎👉 天使救援™ | 账户暂停',

        'account-banned' => '🔎👉 天使救援™ | 帐户锁定',

        'receive-support-enquiry' => '🔎👉 天使救援™ | 感谢您的问询',

        'friend-contact-delete' => '🔎👉 天使救援™ | 需要帮助的朋友',

        'friend-guardian-delete' => '🔎👉 天使救援™ | 需要帮助的朋友',

        'member-delete' => '🔎👉 天使救援™ | 会员已删除',

        'account-delete' => '🔎👉 天使救援™ | 账户已删除',

        'account-security-questions-update' => '🔎👉 天使救援™ | 安全问题更改',

        'members-updated' => '🔎👉 天使救援™ | 会员资料已在过去24小时内更新，',

        'login-remind' => '🔎👉 天使救援™ | 登录提示',

        'contact-nomination-remind' => '🔎👉 天使救援™ | 紧急联系人任命提醒',

        'guardian-nomination-remind' => '🔎👉 天使救援™ | 监护人任命提醒',

        'sync-device' => '🔎👉 天使救援™ | 设置紧急按钮',

        'email-updated' => '🔎👉 天使救援™ | 更新邮箱地址',

        'partner-promos' => '🔎👉 天使救援™ | Promo User Subscription Report',
  ),
  'body' => array(
    'contact-request' => '<p>亲爱的:contact,</p>

<p>您受邀成为:member的天使救援™紧急联系人。</p>

<p>要更了解天使救援™，点击这里<a href=":learnMore">浏览</a>接受邀请。</p>

<p>请登录或注册天使救援™账户<a href=":login">浏览</a>。</p>


<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-request-confirmation' => '<p>亲爱的:account,</p>

<p>天使救援™ :member的紧急联系人的邀请，已经成功发送给:contact。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-cancel' => '<p>亲爱的:contact,</p>

<p>抱歉, :member 已经取消邀请您成为其天使救援™紧急联系人的请求。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-cancel-confirmation' => '<p>亲爱的:account,</p>

<p>您已经取消邀请:contact作为:member天使救援™紧急联系人的请求。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-accept' => '<p>亲爱的:contact,</p>

<p>恭喜, 您已经是 :member 的紧急联系人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-accept-confirmation' => '<p>亲爱的:account,</p>

<p>恭喜您，:contact已经接受您的天使救援™紧急联系人的请求</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-decline' => '<p>亲爱的:contact,</p>

<p>您已经拒绝了成为 :member 天使救援™紧急联系人的请求。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-decline-confirmation' => '<p>亲爱的:account,</p>

<p>对不起，:contact已经拒绝您邀请其成为您的天使救援™紧急联系人的请求</p>

<p>请<a href=":login">登录</a>到您的账户进行新的任命。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-delete' => '<p>亲爱的:contact,</p>

<p>抱歉, 您已被移出:member 天使救援™紧急联系人的名单</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'contact-delete-confirmation' => '<p>亲爱的:account,</p>

<p>您已经将 :contact 从:member 的天使救援™紧急联系人名单中删除。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-request' => '<p>亲爱的:guardian,</p>

<p>您已经受邀成为 :account 的天使救援™账户监护人。</p>

<p>要更多了解天使救援™，点击这里:learnMore接受邀请，。</p>

<p>请登录或注册天使救援™帐户:login。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-request-confirmation' => '<p>亲爱的:account,</p>

<p>天使救援™ 账户监护人邀请已经成功发送给 :guardian。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-cancel' => '<p>亲爱的:guardian,</p>

<p>抱歉, :account已经取消了您的天使救援™ 账户监护人任命。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-cancel-confirmation' => '<p>亲爱的:account,</p>

<p>您已经取消了天使救援™ :guardian作为账户监护人的任命。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-accept' => '<p>亲爱的:guardian,</p>

<p>恭喜, 您成为天使救援™ :account的账户监护人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-accept-confirmation' => '<p>亲爱的:account,</p>

<p>恭喜您，:guardian已经接受您邀请其成为您天使救援™账户监护人的请求。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-decline' => '<p>亲爱的:guardian,</p>

<p>您已经拒绝了成为:account监护人的请求。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-decline-confirmation' => '<p>亲爱的:account,</p>

<p>对不起，:guardian已拒绝您邀请其成为您的天使救援™账户监护人的请求。</p>

<p>请<a href=":login">登录</a>到您的账户，并邀请其他。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-delete' => '<p>亲爱的:guardian,</p>

<p>抱歉, :account 已将您从其天使救援™ 的监护人名单中删除。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'guardian-delete-confirmation' => '<p>亲爱的:account,</p>

<p>您已经将 :guardian 从您的天使救援™ 监护人名单中删除。</p>

<p>请<a href=":login">登录</a>到您的帐户，并任命另一人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'friend-contact-delete' => '<p>亲爱的:contact,</p>

<p>这是一个确认信息：您已经将自己从:member的天使救援™紧急联系人名单中删除。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'friend-contact-delete-confirmation' => '<p>亲爱的:account,</p>

<p>抱歉, :contact 已经把自己从 :member的天使救援™ 紧急联系人名单中删除</p>

<p>请<a href=":login">登录</a>到您的账户，并任命另一人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'friend-guardian-delete' => '<p>亲爱的:guardian,</p>

<p>这是一个确认信息：您已成功将自己从 :account的天使救援™账户监护人名单中删除。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'friend-guardian-delete-confirmation' => '<p>亲爱的:account,</p>

<p>抱歉, :guardian 已经把自己从您的天使救援™ 账户监护人名单中删除了。</p>

<p>请<a href=":login">登录</a>到您的账户，并任命另一人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'member-delete' => '<p>亲爱的:contact,</p>

<p>您的天使救援™ 朋友 :member 已经从系统删除。</p>

<p>您不需要进行其他操作。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'member-delete-confirmation' => '<p>亲爱的:account,</p>

<p>这是一个确认信息：天使救援™子账号:member已从您的账户中删除。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-delete-confirmation' => '<p>亲爱的:account,</p>

<p>这是一个确认信息：您的天使救援™账户已被删除。</p>

<p>我们很遗憾看到您离开。感谢您使用我们的服务。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'member-profile-viewed-confirmation' => '<p>亲爱的:account,</p>

<p>请注意，由于紧急警报已触发，:member的天使救援™急救资料已经被:contact查看。 </p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-members-updated' => '<p>亲爱的:account,</p>

<p>这是一个确认信息：以下天使救援™会员资料已在过去24小时内有过编辑或修改。</p>

<p>您可以<a href=":login">登录</a>到账户查看他们的个人资料：</p>

<p>:members</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-login-remind' => '<p>亲爱的:account,</p>

<p>最近没有您的消息</p>

<p>欢迎随时<a href=":login">登录</a>到您的账户，并查看您的最新会员资料信息：</p>

<p>:members</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-activate' => '<p>谢谢您注册天使救援™。欢迎加入我们的社区。</p>

    <p>首先您需要验证您的电子邮件地址。请点击这里<a href=":activationLink">浏览</a>激活您的天使救援™账户。</p>
<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-notify-about-contacts' => '<p>亲爱的:account,</p>

<p>所有会员至少需要任命一位<a href=":addContactLink">紧急联系人</a>，两位更好，以便在紧急情况下联系您的家人。</p>

<p>出于安全因素的考虑，我们强烈建议您至少任命一名不经常与您一起生活或者旅行的亲友作为您的紧急联系人。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-suspended' => '<p>亲爱的:account,</p>

<p>由于多次尝试登录失败，我们已经暂停您的账户。</p>

<p>请等待15分钟，然后再次<a href=":login">登录</a>。如果您怀疑发生了恶意账户登录活动，请直接联系我们support@iceangelid.com。</p>
<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-banned' => '<p>亲爱的:account,</p>

<p>由于多次尝试重置密码失败，我们已经暂停您的账户。</p>

<p>请等待15分钟，然后再次<a href=":login">登录</a>。如果您怀疑有恶意账户登录的行为，请直接联系我们support@iceangelid.com。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-password-reminder-success' => '<p>亲爱的:account,</p>

<p>您的密码已修改成功。如果您未进行此操作，请立即<a href=":login">重置</a>您的密码。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
'account-passwordupdated-reminder-success' => '<p>亲爱的:account,</p>

<p>您的密码已成功更新</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',

    'account-password-reminder' => '<p>亲爱的:account,</p>

<p>已收到重置您的天使救援™账户密码的请求。您可以<a href=":resetLink">点击</a>这里设置您的新密码。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'share-profile' => '<p>您好</p>

<p>:member 向您分享其天使救援™账户档案。</p>

<p>您只能在未来48小时内<a href=":url">访问该档案</a>。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'support-receive' => '<p>亲爱的:account,</p>
    
    <p>:ice_id_str</p>

<p>感谢您联系天使救援™。我们将尽快回复您的邮件。</p>

<p> :subject</p>

<p> :message</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'emergency-alert' => '<p>亲爱的:account,</p>

<p>:member的天使救援™急救警报已被触发</p>

<p>触发警报的天使的联系方式是:angel</p>

<p>请问询该天使是否已经联系了警察或救护车，因为这是第一步也是最重要的一步。</p>

<p>该警报已发送到：</p>

<p>:contacts</p>

<p>要访问:member的急救记录，请<a href=":sharedProfileLink">点击</a>这里或<a href=":login">登录</a>到您的天使救援™账户。</p>

<p>您只能在未来48小时内访问到:member的急救记录。</p>

<p>
    真诚的，<br/>

    天使救援™自动警报系统
</p>',
    'panic-alert' => '<p>亲爱的:account,</p>

<p> :member已触发了其天使救援™紧急按钮。</p>

<p>:member的联系方式是:angel</p>

<p>该警报已发送到：</p>

<p>:contacts</p>

<p>要访问:member的急救信息，请<a href=":sharedProfileLink">点击</a>这里或<a href=":login">登录</a>到您的天使救援™账户。</p>

<p>您只能在未来48小时内访问:member的急救信息。</p>

<p>
   真诚的，<br/>

   天使救援™自动警报系统
</p>',
    'member-transfer' => '<p>亲爱的:member</p>

<p>:account邀请您成为独立账户持有人, 请<a href=":transferLink">点击</a>这里进行操作。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-update-email' => '<p>亲爱的:account</p>

<p>您已请求更换邮箱地址, 请<a href=":confirmationLink">点击这里</a>验证。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-update-email-notify' => '<p>亲爱的:account</p>

<p> 您账号的邮箱地址已更新为:email。如果您未进行过此操作，那么为了您的账号安全，请进入账号设置中修改您的邮箱地址和密码。 </p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'member-sync-device-request' => '<p>亲爱的:account</p>

<p>:member 请求将该号码 :phone绑定紧急按钮。若接受此请求，请 <a href=":login">登录</a> 您的账号进行操作。</p>

<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'account-security-questions-updated' => '<p>亲爱的:account</p>

<p>
您的账号密保问题已修改成功。如果您未进行此操作，请立即前往您的 <a href=":account-settings">账号设置</a> 更改您的密保问题。
<p>
    真诚的，<br/>

    天使救援™团队
</p>',
    'partner-quota' => '<p>Dear Partner</p>

<p>Here is your monthly promo usage report.</p>
<p>Users registered in our platform using your promotions:</p>
<p>This month  :   :month</p>
<p>Total users:   :total of :quota</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
</p>

<p>
This is an automated report, if you have any enquiries please contact us at :support-email
</p>',
  ),
);

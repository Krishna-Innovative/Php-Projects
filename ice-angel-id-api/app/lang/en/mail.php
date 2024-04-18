<?php

return array(
  
 'subjects' => [

    'contact-request' => '🔎👉 iCE Angel - ID™ | Emergency Contact Person Nomination',

    'guardian-request' => '🔎👉 iCE Angel - ID™ | Guardian Nomination',

    'account-activation' => '🔎👉 iCE Angel - ID™ | Account Activation',

    'account-invitation' => '🔎👉 iCE Angel - ID™ | Account Invitation',

    'password-reset' => '🔎👉 iCE Angel - ID™ | Password Reset',

    'password-updated' => '🔎👉 iCE Angel - ID™ | Password Update',

    'emergency-alert' => '🔎👉 iCE Angel - ID™ | Emergency Alert',

    'panic-alert' => '🔎👉 iCE Angel - ID™ | Panic Alert',

    'email-verification' => '🔎👉 iCE Angel - ID™ | Verify Email Address',

    'email-updated' => '🔎👉 iCE Angel - ID™ | Email Address Update',

    'share-profile' => '🔎👉 iCE Angel - ID™ | Member Profile',

    'account-suspended' => '🔎👉 iCE Angel - ID™ | Account Suspended',

    'account-banned' => '🔎👉 iCE Angel - ID™ | Account Locked',

    'receive-support-enquiry' => '🔎👉 iCE Angel - ID™ | Thank you for your enquiry',

    'friend-contact-delete' => '🔎👉 iCE Angel - ID™ | Friend In Need',

    'friend-guardian-delete' => '🔎👉 iCE Angel - ID™ | Friend In Need',

    'member-delete' => '🔎👉 iCE Angel - ID™ | Member Deleted',

    'account-delete' => '🔎👉 iCE Angel - ID™ | Account Deleted',

    'account-security-questions-update' => '🔎👉 iCE Angel - ID™ | Security Question Update',

    'members-updated' => '🔎👉 iCE Angel - ID™ | Member Profiles Updated in the last 24 hours',

    'login-remind' => '🔎👉 iCE Angel - ID™ | Login Reminder',

    'contact-nomination-remind' => '🔎👉 iCE Angel - ID™ | Emergency Contact Person Nomination Reminder',

    'guardian-nomination-remind' => '🔎👉 iCE Angel - ID™ | Guardian Nomination Reminder',
    
    'sync-device' => '🔎👉 iCE Angel - ID™ | Panic Button Setup',

    'email-updated' => '🔎👉 iCE Angel - ID™ | Email Address Updated',

    'partner-promos' => '🔎👉 iCE Angel - ID™ | Promo User Subscription Report',

    'monthly-user-list' => '🔎👉 iCE Angel - ID™ | New Users List Report',

],

'body' => array(

    'contact-request' => '<p>Dear :contact,</p>

    <p>You have been nominated by :member as their iCE Angel – ID&trade; emergency contact person.</p>

    <p>To learn more about iCE Angel – ID&trade;, go <a href=":learnMore">here</a>.</p>

    <p>To accept the request, please login or register an account <a href=":login">here</a>.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-request-confirmation' => '<p>Dear :account,</p>

    <p>The iCE Angel – ID&trade; emergency contact person nomination for :member has successfully been sent to :contact.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-cancel' => '<p>Dear :contact,</p>

    <p>Sorry, :member has canceled your iCE Angel – ID&trade; emergency contact person nomination.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-cancel-confirmation' => '<p>Dear :account,</p>

    <p>You have canceled the iCE Angel – ID&trade; emergency contact person nomination of :contact for :member.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-accept' => '<p>Dear :contact,</p>

    <p>Congratulations, you are the iCE Angel – ID&trade; emergency contact person for :member.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-accept-confirmation' => '<p>Dear :account,</p>

    <p>Congratulations, :contact has accepted your iCE Angel – ID&trade; emergency contact person nomination.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-decline' => '<p>Dear :contact,</p>

    <p>You have declined the iCE Angel – ID&trade; emergency contact person nomination for :member.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-decline-confirmation' => '<p>Dear :account,</p>

    <p>Sorry, :contact has declined your iCE Angel – ID&trade; emergency contact person nomination</p>

    <p>Please <a href=":login">login</a> to your account and nominate another person.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-delete' => '<p>Dear :contact,</p>

    <p>Sorry, :member has deleted you as their iCE Angel – ID&trade; emergency contact person.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'contact-delete-confirmation' => '<p>Dear :account,</p>

    <p>You have deleted :contact as the iCE Angel – ID&trade; emergency contact person for :member.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-request' => '<p>Dear :guardian,</p>

    <p>You have been nominated by :account to be their iCE Angel – ID&trade; account guardian.</p>

    <p>To learn more about iCE Angel – ID&trade;, go <a href=":learnMore">here</a>.</p>

    <p>To accept the request, please login or register an account <a href=":login">here</a>.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-request-confirmation' => '<p>Dear :account,</p>

    <p>The iCE Angel – ID&trade; account guardian nomination has successfully been sent to :guardian.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-cancel' => '<p>Dear :guardian,</p>

    <p>Sorry, :account has canceled your iCE Angel – ID&trade; account guardian nomination.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-cancel-confirmation' => '<p>Dear :account,</p>

    <p>You have canceled the iCE Angel – ID&trade; account guardian nomination of :guardian.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-accept' => '<p>Dear :guardian,</p>

    <p>Congratulations, you are the iCE Angel – ID&trade; account guardian for :account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-accept-confirmation' => '<p>Dear :account,</p>

    <p>Congratulations, :guardian has accepted your iCE Angel – ID&trade; account guardian nomination</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-decline' => '<p>Dear :guardian,</p>

    <p>You have declined the iCE Angel – ID&trade; account guardian nomination for :account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-decline-confirmation' => '<p>Dear :account,</p>

    <p>Sorry, :guardian has declined your iCE Angel – ID&trade; account guardian nomination.</p>

    <p>Please <a href=":login">login</a> to your account and nominate another person. </p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-delete' => '<p>Dear :guardian,</p>

    <p>Sorry, :account has deleted you as their iCE Angel – ID&trade; account guardian.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'guardian-delete-confirmation' => '<p>Dear :account,</p>

    <p>You have deleted :guardian as your iCE Angel – ID&trade; account guardian.</p>

    <p>Please <a href=":login">login</a> to your account and nominate another person. </p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'friend-contact-delete' => '<p>Dear :contact,</p>

    <p>This is a confirmation that you have removed yourself as the iCE Angel - ID&trade; emergency contact person for :member.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'friend-contact-delete-confirmation' => '<p>Dear :account,</p>

    <p>Sorry, :contact has removed themselves as the iCE Angel – ID&trade; emergency contact person for :member</p>

    <p>Please <a href=":login">login</a> to your account and nominate another person.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'friend-guardian-delete' => '<p>Dear :guardian,</p>

    <p>This is a confirmation that you have removed yourself as the iCE Angel - ID&trade; account guardian for :account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'friend-guardian-delete-confirmation' => '<p>Dear :account,</p>

    <p>Sorry, :guardian has removed themselves as your iCE Angel – ID&trade; account guardian</p>

    <p>Please <a href=":login">login</a> to your account and nominate another person.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'member-delete' => '<p>Dear :contact,</p>

    <p>Your iCE Angel – ID&trade; friend in need :member has been deleted from the system.</p>

    <p>No further action on your part is necessary.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'member-delete-confirmation' => '<p>Dear :account,</p>

    <p>This is a confirmation that iCE Angel – ID&trade; member profile :member has been deleted from your account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-delete-confirmation' => '<p>Dear :account,</p>

    <p>This is a confirmation that your iCE Angel – ID account&trade; has been deleted.</p>

    <p>We are sad to see you go. Thank you for using our services.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'member-profile-viewed-confirmation' => '<p>Dear :account,</p>

    <p>Please be advised that :member\'s iCE Angel - ID&trade; emergency records have been accessed by
    :contact as a result of an emergency alert being triggered.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-members-updated' => '<p>Dear :account,</p>

    <p>Confirmation that the following iCE Angel – ID&trade; member profiles have been edited or added in the past 24 hours.</p>

    <p>You may <a href=":login">login</a> to your account to view their profiles:</p>

    <p>:members</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-login-remind' => '<p>Dear :account,</p>

    <p>We have not seen you for a while.</p>

    <p>Please take a moment to <a href=":login">login</a> to your account and check that all your member\'s profiles are up to date:</p>

    <p>:members</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-activate' => '<p>Thank you for signing up to iCE Angel - ID&trade;. We are glad to have you join our community.</p>

    <p>Before you can get started, you will need to verify your email address. Please click <a href=":activationLink">here</a> to activate your iCE Angel - ID&trade; account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-notify-about-contacts' => '<p>Dear :account,</p>

    <p>All members must link at least one, but preferably two <a href=":addContactLink">emergency contact persons</a> to their profile so that we can connect you to your family in case of emergency.</p>

    <p>For safety reasons, we strongly recommend that at least one of your emergency contact persons does not normally live or travel together with you.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-suspended' => '<p>Dear :account,</p>

    <p>Due to several failed login attempts, we have temporarily suspended your account to protect your security.</p>

    <p>Please wait for 15 minutes and try <a href=":login">login</a> again, or contact us directly at support@iceangelid.com if you suspect malicious account activity.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-banned' => '<p>Dear :account,</p>

    <p>Due to several failed password reset attempts we have temporarily suspended your account to protect your security.</p>

    <p>Please wait for 15 minutes and try <a href=":login">login</a> again, or contact us directly at support@iceangelid.com if you suspect malicious account activity.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-password-reminder-success' => '<p>Dear :account,</p>

    <p>Your account password has successfully been changed. If you did not do this, please <a href=":login">reset</a> here.</p> your password immediately.

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-passwordupdated-reminder-success' => '<p>Dear :account,</p>

    <p>Your account password has successfully been updated.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-password-reminder' => '<p>Dear :account,</p>

    <p>A request has been received to reset you iCE Angel - ID&trade; account password. You may <a href=":resetLink">click here</a> to enter your new password.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'share-profile' => '<p>Hello</p>

    <p>:member has shared their iCE Angel - ID&trade; profile with you.</p>

    <p>You can only <a href=":url">access this profile</a> for the next 48 hours.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'support-receive' => '<p>Dear :account</p>

    <p>:ice_id_str</p>

    <p>Thank you for contacting iCE Angel - ID&trade;. We will attend to your message as soon as possible.</p>

    <p> :subject</p>

    <p> :message</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'emergency-alert' => '<p>Dear :account</p>

    <p>An iCE Angel - ID&trade; emergency alert has been triggered for :member.</p>

    <p>The Angel that triggered the alert can be contacted at :angel</p>

    <p>Please enquire whether the Angel has already contacted the police or ambulance as this is the first and most important step.</p>

    <p>This alert was sent out to:</p>

    <p>:contacts</p>

    <p>To access :member\'s emergency records, click <a href=":sharedProfileLink">here</a> or <a href=":login">log in</a> to your iCE Angel - ID&trade; account.</p>

    <p>You can only access :member\'s emergency records for the next <i>48 hours</i>.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Automated Alert System
    </p>',
    
    'panic-alert' => '<p>Dear :account</p>

    <p>An iCE Angel - ID&trade; panic alert has been triggered by :member.</p>

    <p>You can contact :member at :angel</p>

    <p>This alert was sent out to:</p>

    <p>:contacts</p>

    <p>To access :member\'s emergency records, click <a href=":sharedProfileLink">here</a> or <a href=":login">log in</a> to your iCE Angel - ID&trade; account.</p>

    <p>You can only access :member\'s emergency records for the next <i>48 hours</i>.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Automated Alert System
    </p>',
    
    'member-transfer' => '<p>Dear :member</p>

    <p>:account has invited you to become an account holder, please <a href=":transferLink">click here</a> to proceed.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-update-email' => '<p>Dear :account</p>

    <p>You have requested to update your account email address, please <a href=":confirmationLink">click here</a> to verify this email address.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-update-email-notify' => '<p>Dear :account</p>

    <p> Your account email address has been updated to :email. If you did not request this update, please go to your account settings and update your email address and password to secure your account. </p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'member-sync-device-request' => '<p>Dear :account</p>

    <p>:member has requested to sync a panic button for cellular number :phone. To accept the request, please <a href=":login">login</a> to your account.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
    
    'account-security-questions-updated' => '<p>Dear :account</p>

    <p>

    Your account security questions have successfully been changed. If you did not do this, please go to your <a href=":account-settings">account settings</a> and update your security questions immediately.
    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
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

    'monthly-userlist-email' => '<p>Dear Admin</p>

    <p>Please find the attachment file of new users for last month.</p>

    <p>
    Sincerely,<br/>

    iCE Angel - ID&trade; Team
    </p>',
),
);

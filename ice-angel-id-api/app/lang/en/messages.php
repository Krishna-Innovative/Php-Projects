<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Message Center Language Lines
    |--------------------------------------------------------------------------
    */

    'guardian' => array(

        'accept' => array(
         
          'to_guardian' => 'Congratulations, you are now the iCE Angel - ID™ guardian for :account',
          
          'to_account' => 'Congratulations, :guardian has accepted your iCE Angel - ID™ guardian nomination',
      ),

        'request' => array(
         
          'to_account' => 'Your iCE Angel – ID account guardian nomination has successfully been sent to :guardian',
          
          'to_guardian' => 'You have been nominated by :account to be their iCE Angel - ID™ account guardian in event that they are incapacitated',
      ),

        'decline' => array(
         
          'to_account' => ':guardian has declined your iCE Angel - ID™ guardian nomination',
          
          'to_guardian' => 'You have declined the iCE Angel - ID™ guardian nomination for :account',
      ),

        'cancel' => array(
         
          'to_account' => 'You have cancelled the nomination of :guardian as your iCE Angel - ID™ guardian',
          
          'to_guardian' => 'Your iCE Angel - ID™ guardian nomination for :account has been cancelled',
      ),

        'delete' => array(
         
          'to_account' => 'You have removed :guardian as your iCE Angel - ID™ guardian',
          
          'to_guardian' => 'You have been removed as the iCE Angel - ID™ guardian for :account',
      ),
        
    ),
    'member' => array(

        'transfer' => array(
         
          'success' => 'Invitation has been successfully sent to :name',
      ),

        'delete' => array(
         
          'to_account' => 'You have deleted the iCE Angel - ID™ member profile :member from your account',
          
          'to_contact' => 'Your Friend in Need, :member has been deleted by :account',
      ),

        'profile' => array(
         
          'viewed' => 'Please be advised that :member\'s iCE Angel - ID™ emergency records have been accessed by :contact as a result of an alert being triggered',
      ),
        
    ),
    'contact' => array(

        'accept' => array(
         
          'to_contact' => 'Congratulations, you are now the iCE Angel - ID™ emergency contact person for :member',
          
          'to_account' => 'Congratulations, :contact has accepted the iCE Angel - ID™ emergency contact person nomination for :member',
      ),

        'request' => array(
         
          'to_account' => 'The iCE Angel – ID emergency contact person nomination for :member has successfully been sent to :contact',
          
          'to_contact' => 'You have been nominated by :member as their iCE Angel – ID emergency contact person',
          
          'to_self' => 'You have nominated yourself as the emergency contact person for :member',
      ),

        'decline' => array(
         
          'to_account' => ':contact has declined the iCE Angel - ID™ emergency contact person nomination for :member',
          
          'to_contact' => 'You have declined the iCE Angel - ID™ emergency contact person nomination for :member',
      ),

        'cancel' => array(
         
          'to_account' => 'You have cancelled the nomination of :contact as the iCE Angel - ID™ emergency contact person for :member',
          
          'to_contact' => 'Your iCE Angel - ID™ emergency contact person nomination for :member has been cancelled',
      ),

        'delete' => array(
         
          'to_account' => 'You have removed :contact as the iCE Angel - ID™ emergency contact person for :member',
          
          'to_contact' => 'You have been removed as the iCE Angel - ID™ emergency contact person for :member',
      ),
        
    ),
    'sync' => array(

        'request' => ':member has requested to sync a panic button for cellular number :phone',

        'accept' => ':member\'s panic button has successfully been synced to cellular number :phone',

        'decline' => ':member\'s panic button for cellular number :phone has been un-synced',
        
    ),
    'push_notifications' => array(

        'alert' => array(
         
          'normal' => 'An emergency alert has been triggered for :member',
          
          'panic' => 'A panic button has been triggered by :member',
      ),

        'account' => array(
         
          'suspended' => 'Due to suspicious activity on your account and to protect your security, we have temporarily suspended your account',
          
          'banned' => 'Due to suspicious activity on your account and to protect your security, we have temporarily locked your account',
          
          'reset-password' => 'You have successfully reset your password for your iCE Angel - ID™ account',
      ),

        'contact' => array(
         
          'request' => 
          array(
           
            'account' => 'The iCE Angel – ID emergency contact person nomination for :member has successfully been sent to :contact',
            
            'contact' => 'You have been nominated by :member as their iCE Angel – ID emergency contact person',
        ),
          
          'accept' => 
          array(
           
            'account' => 'Congratulations, :contact has accepted the iCE Angel - ID™ emergency contact person nomination for :member',
            
            'contact' => 'Congratulations, you are now the iCE Angel - ID™ emergency contact person for :member',
        ),
          
          'decline' => 
          array(
           
            'account' => ':contact has declined the iCE Angel - ID™ emergency contact person nomination for :member',
            
            'contact' => 'You have declined the iCE Angel - ID™ emergency contact person nomination for :member',
        ),
          
          'cancel' => 
          array(
           
            'account' => 'You have cancelled the nomination of :contact as the iCE Angel - ID™ emergency contact person for :member',
            
            'contact' => 'Your iCE Angel - ID™ emergency contact person nomination for :member has been cancelled',
        ),
          
          'delete' => 
          array(
           
            'account' => 'You have removed :contact as the iCE Angel - ID™ emergency contact person for :member',
            
            'contact' => 'You have been removed as the iCE Angel - ID™ emergency contact person for :member',
        ),
      ),

        'guardian' => array(
         
          'request' => 
          array(
           
            'account' => 'Your iCE Angel – ID account guardian nomination has successfully been sent to :guardian',
            
            'guardian' => 'You have been nominated by :account to be their iCE Angel - ID™ account guardian in event that they are incapacitated',
        ),
          
          'accept' => 
          array(
           
            'account' => 'Congratulations, :guardian has accepted your iCE Angel - ID™ guardian nomination',
            
            'guardian' => 'Congratulations, you are now the iCE Angel - ID™ guardian for :account',
        ),
          
          'decline' => 
          array(
           
            'account' => ':guardian has declined your iCE Angel - ID™ guardian nomination',
            
            'guardian' => 'You have declined the iCE Angel - ID™ guardian nomination for :account',
        ),
          
          'cancel' => 
          array(
           
            'account' => 'You have cancelled the nomination of :guardian as your iCE Angel - ID™ guardian',
            
            'guardian' => 'Your iCE Angel - ID™ guardian nomination for :account has been cancelled',
        ),
          
          'delete' => 
          array(
           
            'account' => 'You have removed :guardian as your iCE Angel - ID™ guardian',
            
            'guardian' => 'You have been removed as the iCE Angel - ID™ guardian for :account',
        ),
      ),

        'friends' => array(
         
          'delete_contact' => 
          array(
           
            'contact' => 'You have removed yourself as the emergency contact person for :member',
            
            'account' => ':contact has removed themself as the emergency contact person for :member',
        ),
          
          'delete_guardian' => 
          array(
           
            'guardian' => 'You have successfully removed yourself as the iCE Angel - ID™ account guardian for :account',
            
            'account' => ':guardian has removed themselves as your account guardian',
        ),
      ),

        'member' => array(
         
          'delete' => 
          array(
           
            'account' => 'You have deleted the iCE Angel - ID™ member profile :member from your account',
            
            'contact' => 'Your Friend In Need :member, has been deleted by :account',
        ),
          
          'profile' => 
          array(
           
            'viewed' => 'Please be advised that :member\'s iCE Angel - ID™ emergency records have been accessed by :contact as a result of an alert being triggered',
        ),
      ),
        
    ),
'twitter_notifications' => array(

    'alert' => array(
     
      'normal' => 'An emergency alert has been triggered by :member_first_name :member_last_name',
      
      'panic' => 'A panic button has been triggered for :member_first_name :member_last_name',
  ),
    
),
'messenger_notifications' => array(

    'alert' => array(

        'normal' => 'An emergency alert has been triggered for :member_full_name',

        'panic' => 'A panic button has been triggered for :member_full_name',

        'button' => 'View Website',

        'subtitle' => 'This is an automated alert. For details please login into your account'
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
     
      'to_contact' => 'You have removed yourself as the emergency contact person for :member',
      
      'to_account' => ':contact has removed themself as the emergency contact person for :member',
  ),

    'delete_guardian' => array(
     
      'to_guardian' => 'You have successfully removed yourself as the iCE Angel - ID™ account guardian for :account',
      
      'to_account' => ':guardian has removed themselves as your account guardian',
  ),
    
),
'auth' => array(

    'account' => array(
     
      'suspended' => 'Due to suspicious activity on your account and to protect your security, we have temporarily suspended your account',
      
      'banned' => 'Due to suspicious activity on your account and to protect your security, we have temporarily locked your account',
      
      'reset-password' => 'You have successfully reset your password',

      'updated-password' => 'You have successfully updated your password',
  ),
    
),
'account' => array(

    'members-updated' => 'The following iCE Angel – ID member profiles: (:members) have been edited or added',

    'questions-updated' => 'Your account security questions have successfully been changed',

    'email' => 'Your account email address has been updated to :email',

    'email-updated-message' => 'Account email address was updated',
),
);

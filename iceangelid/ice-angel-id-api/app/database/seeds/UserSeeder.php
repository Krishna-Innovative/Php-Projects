<?php
 

class UserSeeder extends Seeder {
 
  public function run()
  {  
  	$faker = Faker\Factory::create();

	$first_name = 'Fake';
	$last_name = 'Fake';
	$birth_date = array('year' => 1970 , 'month' => 4, 'day' => 3);
	$nationality = 237;
	$gender = 1;
	$language = 'en';	
	$mobile = array('code'=>47, 'number'=>'13818176097');
	$email = 'fake10001@fake.com';
	$password = '13818176097';

	$channels = array('emergency_channel1' 
				=> array('id' => 1,
						 'value' => $email,
						 'type' => 'email',
						 'name' => 'Email'));

	$data = array(
		  'email' => $email,
		  'password' => $password,
		  'birth_date' => $birth_date,
		  'first_name' => $first_name,
		  'last_name' => $last_name,
		  'language' => $language,
		  'security_question_1' => null,
		  'security_question_2' => null,
		  'nationality' => $nationality,
		  'gender' => $gender,
		  'phone' => $mobile,
		  // 'photo' => 'https://randomuser.me/api/portraits/'.$gender_photo.'/'.$i.'.jpg',
		  'emergency_channels' => $channels,
	);

	// Create the Account
	$account = Sentry::createUser($data);

	$account->account_id = $account->id;
	$account->save();
	$accountGroup = Sentry::findGroupByName('Account');
	$account->addGroup($accountGroup);

	$account->attemptActivation($account->getActivationCode());

    //pre-generate qr code after
    $gen = new \PHPQRCode\QRcode();
    $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;
    $qrGenerator->generateAndUpload($account->ice_id);

  }
 
}
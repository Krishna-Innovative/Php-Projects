<?php
 

class UserTableSeeder extends Seeder {
 
  public function run()
  {  
  	$faker = Faker\Factory::create();
	$faker_zh = Faker\Factory::create('zh_CN');

	for ($i = 1; $i <= 100; $i++)
	{

		$gender = $faker->randomElement(array(1,2)); // 1 = male;
		$language = $faker->randomElement(array ('en','zh'));
		$gender_photo = $gender === 1 ? 'men' : 'women';

		if ($language === 'zh'){

			$first_name = $faker_zh->lastName($gender);
			$last_name = $faker_zh->firstName($gender);
		
		}else{

			$first_name = $faker->firstName($gender);
			$last_name = $faker->lastName($gender);
		}

		$channels = array('emergency_channel1' 
					=> array('id' => 1,
							 'value' => 'test'.$i.'@iceangelid.com',
						 	 'type' => 'email',
						 	 'name' => 'Email'));

	  	$data = array(
		  'email' => 'test'.$i.'@iceangelid.com',
		  'password' => 'asd123',
		  'birth_date' => array('year' => $faker->numberBetween(1920,1990) , 
		  						'month' => $faker->numberBetween(1,12), 
		  						'day' => $faker->numberBetween(1,28)),
		  'first_name' => $first_name,
		  'last_name' => $last_name,
		  'language' => $language,
		  'security_question_1' => null,
		  'security_question_2' => null,
		  'nationality' => $faker->numberBetween(1,251),
		  'gender' => $gender,
		  'phone' => array('code'=>238, 'number'=>'+1 '.$faker->phoneNumber),
		  'photo' => 'https://randomuser.me/api/portraits/'.$gender_photo.'/'.$i.'.jpg',
		  'emergency_channels' => $channels
		);

	    // Create the Account
		$account = Sentry::createUser($data);

		$account->account_id = $account->id;
		$account->save();
		$accountGroup = Sentry::findGroupByName('Account');
		$account->addGroup($accountGroup);

		$account->attemptActivation($account->getActivationCode());

	}

  }
 
}
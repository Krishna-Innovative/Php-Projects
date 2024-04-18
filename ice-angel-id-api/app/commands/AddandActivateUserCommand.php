<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Output\BufferedOutput;


class AddandActivateUserCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:add-user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add and activate user via command';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$filepath = $this->getArgument('filepath', null);

		if (isset($filepath))
		{
			$csvFile = file($filepath);
			$data = [];
    	
			//pre-check all emails must be unique
			foreach ($csvFile as $line) {

				$data = str_getcsv($line);

				if (empty($data[10])){
					throw new \InvalidArgumentException('email is mandatory');
				}

				$user = \Member::findByEmail($data[10]);

	            if (!empty($user)){
	                throw new \InvalidArgumentException('Emails must be unique: '.$data[10]);
	            }
			}

    		foreach ($csvFile as $line) {

				$data = str_getcsv($line);

				$first_name = $data[0];
				$last_name = $data[1];
				$birth_date = array('year' => $data[2] , 'month' => $data[3], 'day' => $data[4]);
				$nationality = $data[5];
				$gender = $data[6];
				$language = $data[7];
				$mobile = array('code'=>intval($data[8]), 'number'=>$data[9]);
				$email = $data[10];
				$password = empty($data[11]) ? ''.$data[2].$data[3].$data[4] : $data[11];

				$channels = array('emergency_channel1' 
								=> array('id' => 1,
										 'value' => $email,
										 'type' => 'email',
										 'name' => 'Email'));

				$user = array(
				  'email' => $email,			/* mandatory */
				  'password' => $password,		/* mandatory  but default to DoB YYYYMMDD*/
				  'birth_date' => $birth_date, 	/* mandatory */
				  'first_name' => $first_name,
				  'last_name' => $last_name,
				  'language' => $language,
				  'security_question_1' => null,
				  'security_question_2' => null,
				  'nationality' => $nationality,
				  'gender' => $gender,
				  'phone' => $mobile,
				  
				  // 'photo' => '',
				  'emergency_channels' => $channels,);

				// Create the Account
				$account = Sentry::createUser($user);

				$account->account_id = $account->id;
				$account->save();
				$accountGroup = Sentry::findGroupByName('Account');
				$account->addGroup($accountGroup);


				$memberPersonal = new MemberPersonal(array('member_id' => $account->id,
															'home_phone' => array('code' => null, 'number' => null),
															'workplace_phone' => array('code' => null, 'number' => null)));

				$account->attemptActivation($account->getActivationCode());

				$memberPersonal->save();

			    //pre-generate qr code after
			    $gen = new \PHPQRCode\QRcode();
			    $qrGenerator = new \IceAngel\Support\Helpers\QrCode($gen) ;
			    $qrGenerator->generateAndUpload($account->ice_id);

				\Log::info('New Account Pre-registered', $data);

				// insurance_type, company_name, phone(code, number) are required
				if (!empty($data[12]) && !empty($data[13]) && !empty($data[16]) && !empty($data[17])){

					$insurance = array(
						'member_id' => $account->account_id, 
						'insurance_type' => $data[12],
						'company_name' => $data[13],
						'number' => !empty($data[14]) ? trim($data[14]) : '', 
						'plan_type' => !empty($data[15]) ? $data[15] : null, 
						'company_phone' => !empty($data[16]) && !empty($data[17]) ? array('code'=> intval($data[16]), 'number'=>trim($data[17])) : null, 
						'notes' => !empty($data[21]) ? $data[21] : null
					);

					$memberInsurance = new MemberInsurance($insurance);

					if (!empty($data[18]) && !empty($data[19]) && !empty($data[20])){
						
						$memberInsurance->expiry_date = array( 'year'  => intval($data[18]), 'month' => intval($data[19]), 'day' => intval($data[20]));
					}
					
					$memberInsurance->save();

					\Log::info('Insurance info saved (pre-registered)', array($email, $data[13]));

				}

			} 	// end for

		}	//end if

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('filepath', InputArgument::REQUIRED, 'A valid file is required'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

	protected function getArgument($name, $defaultValue)
    {
        $var = $this->argument($name);

        if (is_null($var)) {
            return $defaultValue;
        }

        return $var;
    }

}

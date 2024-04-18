<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCouponsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:generate-coupons';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate coupons in bulk from a file';

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

		$partner_id = $this->getArgument('partner-id', 0);
		$filepath = $this->getArgument('filepath', null);


		if (isset($filepath))
		{
			$plainFile = file($filepath);
			$data = [];

			Stripe::setApiKey(Config::get('services.stripe.secret'));

			$user = \Account::find($partner_id);

	        if (!empty($user)){
	        	throw new \InvalidArgumentException('Partner doesnt exists '.$partner_id);
			}


			//pre-check all bins haven't been used as coupons
			foreach ($plainFile as $line) {

				$coupon_id = trim($line);

				if (Coupon::exists($coupon_id)){
					
					throw new \InvalidArgumentException('Coupon already in use ' . $coupon_id);
				}

				$data[] = $coupon_id;
			}


			for ($i=0; $i < count($data); $i++) { 
			
				$coupon_id = $data[$i];

				try{

					$redeem_date = \Carbon\Carbon::now()->addDays(30);

					$params = array('percent_off' => 100,
									'duration' => 'once', 
									'max_redemptions' => 1, 
									// 'redeem_by' => $redeem_date->timestamp,
									'metadata' => array('partner_id' => $partner_id),
									'id' => $coupon_id);

					$stripe_coupon = Stripe_Coupon::create($params);

					$stripe_coupon->save();

					$values = array(
							'code' => $coupon_id,
							'partner_id' => $partner_id,
							'account_id' => null);

					$coupon = Coupon::create($values);

					$this->info('Coupon ' . $coupon_id . ' ' . ($i + 1) . '/' . (count($data) + 1));

				}catch(Exception $e){

					return $this->error($e->getMessage());

				}
			}

			$this->info('Done!');

		}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('partner-id', InputArgument::REQUIRED, '66'),
			array('filepath', InputArgument::REQUIRED, ''),

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

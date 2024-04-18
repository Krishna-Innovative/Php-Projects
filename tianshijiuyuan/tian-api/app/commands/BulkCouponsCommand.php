<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BulkCouponsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:bulk-coupons';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate coupons in bulk with a prefix';

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

		$prefix = $this->getArgument('prefix', '');
		$count = $this->getArgument('count',10);
		$total_length = 7;

		if (strlen($prefix) >= $total_length){

			$this->error('Total length must be larger than prefix! End');

		}

		Stripe::setApiKey(Config::get('services.stripe.secret'));

		try{

			for ($i=0; $i < $count; $i++){

				$coupon_id = $this->genCouponID($prefix, $total_length);

				$redeem_date = \Carbon\Carbon::now()->addDays(30);

				$params = array('percent_off' => 100,
								'duration' => 'once', 
								'max_redemptions' => 1, 
								'metadata' => array('promo_prefix' => $prefix),
								'id' => $coupon_id);

				$stripe_coupon = Stripe_Coupon::create($params);

				$stripe_coupon->save();

				$values = array('code' => $coupon_id, 'partner_id' => null, 'account_id' => null);

				$coupon = Coupon::create($values);

				$this->info('Coupon ' . $coupon_id . ' ' . ($i + 1) . '/' . ($count));

			}

		}catch(Exception $e){

			return $this->error($e->getMessage());

		}

		$this->info('Done!');

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('prefix', InputArgument::REQUIRED, ''),
			array('count', InputArgument::REQUIRED, '10'),

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


    protected function genCouponID($prefix, $total_length){

    	$exists = true;
		$coupon_id = '';
    	
    	while($exists){
			
			$coupon_id = $prefix . generate_code($total_length - strlen($prefix));

			$exists = Coupon::exists($coupon_id);
    	}


    	return $coupon_id;
    }

}

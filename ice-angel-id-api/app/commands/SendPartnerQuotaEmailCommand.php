<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class SendPartnerQuotaEmailCommand extends Command {

	use \IceAngel\Traits\NotificationHelpersTrait;


	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:send-partner-quota-email';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Monthly email with coupon quota information';

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

	    $emails = array_filter(array($this->getArgument('email1', null), 
	   								 $this->getArgument('email2', null),
	   								 Config::get('mail.emails.admin')));

	    // TODO: prefix and quota are hard-coded
		$data = [ 
				  'month' => '' . Coupon::countByPrefixDate('VC', Carbon::today()->subMonth()),
                  'total' => '' . Coupon::countByPrefix('VC'),
                  'quota' => number_format($this->getArgument('quota', 50000)),
                  'support-email' => Config::get('mail.emails.support')
             	];


	   foreach ($emails as $email) {
       		
       		$this->notifyViaEmail($email, 'partner-quota', 'partner-promos', $data, Config::get('app.locale'));

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
			array('quota', InputArgument::REQUIRED, 0),
			array('email1', InputArgument::REQUIRED, null),
			array('email2', InputArgument::OPTIONAL, null),
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

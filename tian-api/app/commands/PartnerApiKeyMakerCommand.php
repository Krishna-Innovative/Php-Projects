<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\Console\Output\BufferedOutput;


class PartnerApiKeyMakerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:partner-key';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create API key for Partner accounts';

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

		$account = Account::find($this->getArgument('user-id', 0));

		if(isset($account)){
			$this->call('api-key:generate', array());
		
			$apiKey = Chrisbjr\ApiGuard\Models\ApiKey::orderBy('created_at', 'desc')->first();

			$apiKey->user_id = $account->id;

			$apiKey->save();

		}else{
			$this->error('Argument must be valid user ID');
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
			array('user-id', InputArgument::REQUIRED, 'A valid user id is required'),
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

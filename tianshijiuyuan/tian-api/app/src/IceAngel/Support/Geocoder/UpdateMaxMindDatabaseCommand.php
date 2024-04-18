<?php namespace IceAngel\Support\Geocoder;

use Illuminate\Console\Command;

class UpdateMaxMindDatabaseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'iceangel:maxmind-update-db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update GeoIP2 MaxMind database.';

    /**
     * @var Client
     */
    protected $client;

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->info('Command under development!');
    }

}

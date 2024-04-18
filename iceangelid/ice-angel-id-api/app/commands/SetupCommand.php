<?php

use Illuminate\Console\Command;

class SetupCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'iceangel:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install migrations and configurations.';

    /**
     * Create a new command instance.
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
        try {

            // Install Sentry migrations
            $this->call('migrate', array('--package' => 'cartalyst/sentry'));

            $this->call('migrate');

            $this->call('db:seed');

        } catch (Exception $e) {

            $this->error($e->getMessage());
        }
    }
}

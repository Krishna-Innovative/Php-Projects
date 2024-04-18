<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;

class NominationReminderCommand extends ScheduledCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'iceangel:nomination-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind nominated ECPs and Guardians to respond to Account nominations';

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
     * When a command should run
     *
     * @param Scheduler $scheduler
     * @return \Indatus\Dispatcher\Scheduling\Schedulable
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->daily();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $nominations = PendingRequest::findNominatedBefore(\Carbon\Carbon::now()->subHours(72));

        Event::fire('accounts.nomination-reminder.scheduled-notification', [$nominations]);

        Log::info('Remind Account Holders that they need to update their information');
    }
}

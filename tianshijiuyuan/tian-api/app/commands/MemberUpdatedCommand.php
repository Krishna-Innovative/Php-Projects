<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;

class MemberUpdatedCommand extends ScheduledCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'iceangel:notify-update-profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Account holder when one of their member\'s profile was updated in the last 24 hours';

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
        $members = Member::findUpdatedAfter(\Carbon\Carbon::now()->subHours(24));

        Event::fire('members.updated.scheduled-notification', [$members]);

        Log::info('Notify Account Holders that their member profiles were updated');
    }
}

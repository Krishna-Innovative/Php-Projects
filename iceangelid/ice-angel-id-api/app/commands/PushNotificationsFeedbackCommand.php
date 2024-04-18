<?php

use IceAngel\PushNotifications\NotificationPusher;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;

class PushNotificationsFeedbackCommand extends ScheduledCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'iceangel:push-notifications-feedback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean device tokens which not have the application installed';

    /**
     * @var NotificationPusher
     */
    private $pusher;

    /**
     * Create a new command instance.
     *
     * @param NotificationPusher $pusher
     */
    public function __construct(NotificationPusher $pusher = null)
    {
        parent::__construct();

        $this->pusher = $pusher ?: App::make('IceAngel\PushNotifications\NotificationPusher');
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
        $feedback = $this->pusher->getFeedback();

        $tokens = array_keys($feedback);

        if (!empty($tokens)) {
            $devices = PushDevice::findByTokens($tokens);

            $devices->each(function (PushDevice $device) use ($feedback) {
                if ($device->updated_at->lte(\Carbon\Carbon::createFromTimestamp($feedback[$device->token]->getTimestamp()))) {
                    $device->delete();
                }
            });

            Log::info(sprintf('PushNotifications feedback: the following token (%s) have been removed', implode(', ', $tokens)));
        }
    }
}
<?php namespace IceAngel\Notifications;


use Illuminate\Support\ServiceProvider;
use JPush\JPushClient;

class NotificationServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNotifiers();

        $this->registerJPush();
    }

    /**
     * Register notifiers.
     *
     * @return void
     */
    protected function registerNotifiers()
    {
        $this->app->bindShared('IceAngel\Notifications\NotificationProcessor', function ($app) {

            return new NotificationProcessor([

                $app->make('IceAngel\Notifications\PushNotificationNotifier'),

                $app->make('IceAngel\Notifications\JPushNotifier'),

                $app->make('IceAngel\Notifications\EmailNotifier'),

                $app->make('IceAngel\Notifications\TwitterNotifier'),

            ]);

        });
    }

    /**
     * Register jPush binding
     *
     * @return void
     */
    private function registerJPush()
    {
        $this->app->bindShared('JPush\JPushClient', function ($app) {
            $appKey = $app['config']->get('services.notifications.jpush.appKey');
            $masterSecret = $app['config']->get('services.notifications.jpush.masterSecret');

            $jpush = new JPushClient($appKey, $masterSecret, $retryTimes=3);

            return $jpush;
        });
    }
}

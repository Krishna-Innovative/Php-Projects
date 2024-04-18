<?php namespace IceAngel\PointsSystem;

use Illuminate\Support\ServiceProvider;

class PointsSystemServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerScoreProvider();
    }

    /**
     * Register the score provider implementation.
     */
    private function registerScoreProvider()
    {
        $this->app->bindShared('IceAngel\PointsSystem\ScoreProvider', function ($app) {
            return $app->make('IceAngel\PointsSystem\FileScoreProvider');
        });
    }
}
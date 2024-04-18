<?php namespace IceAngel\Support\Geocoder;

use GeoIp2\Database\Reader;
use Geocoder\HttpAdapter\GeoIP2Adapter;
use Geocoder\Provider\GeoIP2Provider;
use Geocoder\Geocoder;
use Geocoder\Provider\ChainProvider;
use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */    
    public function register()
    {
        $this->registerGeocoder();

        $this->registerCommands();
    }

    /**
     * Register the Geocoder implementation.
     *
     * @return void
     */
    protected function registerGeocoder()
    {
        $this->app->bindShared('iceangel.geocoder', function ($app) {
            $reader = new Reader($app['config']->get('database.maxmind.database'));

            $adapter = new GeoIP2Adapter($reader);

            $chain = new ChainProvider([
                new GeoIP2Provider($adapter),
            ]);

            $geocoder = new Geocoder();

            $geocoder->registerProvider($chain);

            return $geocoder;
        });
    }

    /**
     * Register socket listener.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app['iceangel.command.update-maxmind-db'] = $this->app->share(function()
        {
            return new UpdateMaxMindDatabaseCommand;
        });

        $this->commands(['iceangel.command.update-maxmind-db',]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['iceangel.geocoder'];
    }

}

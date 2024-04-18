<?php
/**
 * Part of the ICEAngel package.
 *
 * @package    ICEAngel/Core
 * @version    0.5.0
 * @copyright  (c) 2016 iCEAngel - ID
 * @link       https://www.iceangelid.com
 */

namespace ICEAngel\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('iceangel/core', 'iceangel/core');

        $this->bootRegistredEventListeners();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setCurrentLanguage();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * Bootstrap the event listeners.
     */
    protected function bootRegistredEventListeners()
    {
        $listerners = $this->app['config']->get('iceangel/core::listeners');

        foreach ($listerners as $listerner) {
            $this->app['events']->listen('ICEAngel.*', $listerner);
        }
    }

    /**
     * Set the application current language.
     */
    protected function setCurrentLanguage()
    {
        $this->app->before(function ($request) {
            $supportedLanguages = $this->app['config']->get('app.supported_languages');

            // Ignore the Accept-Language header if the query string includes lang param
            if ($request->has('lang') && in_array($request->get('lang'), $supportedLanguages)) {
                $language = $request->get('lang');
            } else {
                $language = array_first($request->getLanguages(), function ($index, $language) use ($supportedLanguages) {
                    return in_array($language, $supportedLanguages);
                });
            }

            if ($language) $this->app->setLocale($language);
        });
    }
}

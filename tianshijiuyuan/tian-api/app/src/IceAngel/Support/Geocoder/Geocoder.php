<?php namespace IceAngel\Support\Geocoder;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Geocoder\Geocoder
 */
class Geocoder extends Facade 
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'iceangel.geocoder'; }

}

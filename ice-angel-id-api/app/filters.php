<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

Route::filter('auth.jwt', 'JwtFilter');

/*
|--------------------------------------------------------------------------
| Set global 500 error
|--------------------------------------------------------------------------
|
*/

App::after(function ($request, $response) {
    if ($response->getStatusCode() == 500) {
        $response->setData([
            'error' => [
                'error' => true,
                'type' => 'SystemError',
                'message' => trans('errors.system_error')
            ],
        ]);
    }
});

App::error(function(RuntimeException $exception) {
    return Response::json([
        'error' => [
            'error' => true,
            'type' => 'SystemError',
            'message' => trans('errors.system_error')
        ],
    ], 500);
});

App::before(function ($request) {
    if ($request->getSchemeAndHttpHost() == 'https://www.tianshijiuyuan.com') {
        App::setLocale('zh');
    }
});
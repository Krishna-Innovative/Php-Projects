<?php

/*
 * This file is part of Laravel Flysystem.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => getenv('FLYSYSTEM_DRIVER'),

    /*
    |--------------------------------------------------------------------------
    | Flysystem Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Examples of
    | configuring each supported driver is shown below. You can of course have
    | multiple connections per driver.
    |
    */

    'connections' => [

        'awss3' => [
            'driver' => 'awss3',
            'key' => getenv('FLYSYSTEM_S3_KEY'),
            'secret'    => getenv('FLYSYSTEM_S3_SECRET'),
            'bucket'    => getenv('FLYSYSTEM_S3_BUCKET'),
            'region'    => getenv('FLYSYSTEM_S3_BUCKET_REGION'),
            'version'   => 'latest',
            // 'base_url'   => 'your-url',
            // 'options'    => array(),
            // 'prefix'     => 'your-prefix',
            'visibility' => 'public',
            // 'eventable'  => true,
            // 'cache'      => 'foo'
        ],

        'local' => [
            'driver' => 'local',
            'path' => public_path('uploads'),
            // 'visibility' => 'public',
            // 'eventable'  => true,
            // 'cache'      => 'foo'
        ],

        'null' => [
            'driver' => 'null',
            // 'eventable' => true,
            // 'cache'     => 'foo'
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Flysystem Cache
    |--------------------------------------------------------------------------
    |
    | Here are each of the cache configurations setup for your application.
    | There are currently two drivers: illuminate and adapter. Examples of
    | configuration are included. You can of course have multiple connections
    | per driver as shown.
    |
    */

    'cache' => [

        'foo' => [
            'driver' => 'illuminate',
            'connector' => null, // null means use default driver
            'key' => 'foo',
            // 'ttl'       => 300
        ],

        'bar' => [
            'driver' => 'illuminate',
            'connector' => 'redis', // app/config/cache.php
            'key' => 'bar',
            'ttl' => 600,
        ],

        'adapter' => [
            'driver' => 'adapter',
            'adapter' => 'local', // as defined in connections
            'file' => 'flysystem.json',
            'ttl' => 600,
        ],

    ],

];

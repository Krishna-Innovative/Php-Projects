<?php

/*
|--------------------------------------------------------------------------
| Application Listeners
|--------------------------------------------------------------------------
|
| Below you will find the event listeners for the application.
|
*/

// Account Events handler.
Event::subscribe('AccountEventHandler');

// Alert Events handler.
Event::subscribe('AlertEventHandler');

// Points System Events handler.
Event::subscribe('IceAngel\PointsSystem\PointsSystemEventHandler');

// Watchdog (History) Events handler.
Event::subscribe('WatchdogEventHandler');

// Auth Events handler.
Event::subscribe('AuthEventHandler');

// Notifications/Messaging Event handler
Event::subscribe('MessagingEventHandler');

// ECP permissions settings Event handler
Event::subscribe('PermissionsEventHandler');

// Publisher Event handler
Event::subscribe('PublisherEventHandler');
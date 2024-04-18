<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new SetupCommand);

Artisan::add(new MemberUpdatedCommand);

Artisan::add(new LoginReminderCommand);

Artisan::add(new NominationReminderCommand);

Artisan::add(new PushNotificationsFeedbackCommand);

Artisan::add(new PartnerApiKeyMakerCommand);

Artisan::add(new AddandActivateUserCommand);

Artisan::add(new GenerateCouponsCommand);

Artisan::add(new SendPartnerQuotaEmailCommand);

Artisan::add(new BulkCouponsCommand);

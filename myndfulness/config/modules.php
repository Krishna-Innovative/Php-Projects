<?php

return [
    "currency" => env("CURRENCY", "$"),
    "FREE_USER_ABBILITIES" => [
        "routine:create",
        "routine:update",
        "routine:delete"
    ],
    "PREMIUM_USER_ABBILITIES" => [
        "routine:create",
        "routine:update",
        "routine:delete",
        "self-assesment:create",
        "self-assesment:update",
        "self-assesment:delete",
    ],
    "full_date_format"  => env("FULL_DATE_FORMAT", "d/m/Y H:i a"),
    "short_date_format"  => env("SHORT_DATE_FORMAT", "d/m/Y"),
    "routine_types"  => [
        "Once a day"
    ],
    "APP_STORE_KEY"  => env("APP_STORE_KEY", null),
    "NOTIFICATION_GRACE_DAY"  => env("NOTIFICATION_GRACE_DAY", 3),
];

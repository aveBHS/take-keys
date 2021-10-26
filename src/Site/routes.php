<?php

use Site\Middleware\AdminMiddleware;
use Site\Middleware\GuestMiddleware;
use Site\Middleware\MegafonMiddleware;
use Site\Middleware\PaidUserMiddleware;
use Site\Middleware\UserMiddleware;

return [
    "routes" => [
        "~^[/]?$~" => [
            "controller" => [\Site\Controllers\MainController::class, "view"],
        ],

        // Users
        "~lk[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "view"],
            "middleware" => UserMiddleware::class
        ],
        "~login[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "view"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~login[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "auth"],
            "middleware" => GuestMiddleware::class
        ],
        "~join[/]?$~" => [
            "controller" => [\Site\Controllers\User\JoinController::class, "view"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~join[/]?$~" => [
            "controller" => [\Site\Controllers\User\JoinController::class, "join"],
            "middleware" => GuestMiddleware::class
        ],
        "~logout[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "logout"],
            "middleware" => UserMiddleware::class
        ],
        "~a[/]([A-Za-z0-9=]+)[/]?(.+)?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "tokenAuth"]
        ],

        // PC
        "POST::~api[/]rec[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "disableRecommendations"],
            "middleware" => UserMiddleware::class
        ],

        // Admin Panel
        "GET::~panel[/]?$~" => [
            "controller" => [\Site\Controllers\Admin\MainController::class, "view"],
            "middleware" => AdminMiddleware::class
        ],

        // Objects
        "~id/(.+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CardController::class, "view"],
        ],
        "~catalog[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "view"],
        ],
        "~catalog/recommendations[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "recommendations"],
            "middleware" => UserMiddleware::class
        ],

        // API
        "POST::~api[/]address[/]?$~" => [
            "controller" => [\Site\Controllers\DaDataController::class, "view"]
        ],
        "GET::~api[/]objects[/]recent[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recent"]
        ],
        "GET::~api[/]objects[/]recommendations[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recommendations"],
            "middleware" => UserMiddleware::class
        ],
        "GET::~api[/]objects[/]call[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\VerifyOwnerRequestController::class, "request"],
            "middleware" => PaidUserMiddleware::class
        ],
        "POST::~api[/]settings[/](.+)[/]?$~" => [
            "controller" => [\Site\Controllers\User\CookieSettingsController::class, "config"]
        ],

        // Megafon CRM
        "MIXED::~business[/]mcrm[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\MegafonController::class, "request"],
            "middleware" => GuestMiddleware::class
        ],

        // Tilda webhooks
        "POST::~whook[/]createRequest[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\TildaWebHookController::class, "processRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]editRequest[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\TildaWebHookController::class, "processRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]removeRequest[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\TildaWebHookController::class, "removeRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]payment[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\TildaWebHookController::class, "processPayment"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]booking[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\TildaWebHookController::class, "booking"],
            "middleware" => GuestMiddleware::class
        ],

        "POST::~whook[/]pact[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\PactNotifyController::class, "view"]
        ],
        "POST::~clpay[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\CloudPaymentsWebHookController::class, "view"],
            "middleware" => \Site\Middleware\CloudPaymentsMiddleware::class
        ],
        "MIXED::~whook[/]mtt[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\MTTWebHookController::class, "view"]
        ],
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
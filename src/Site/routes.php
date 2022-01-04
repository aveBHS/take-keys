<?php

use Site\Middleware\AdminMiddleware;
use Site\Middleware\GuestMiddleware;
use Site\Middleware\PaidUserMiddleware;
use Site\Middleware\UserMiddleware;

/** @noinspection PhpFullyQualifiedNameUsageInspection */
return [
    "routes" => [
        "~^[/]?$~" => [
            "controller" => [\Site\Controllers\MainController::class, "view"],
        ],
        "~test[/]?$~" => [
            "controller" => [\Site\Controllers\MainController::class, "test"],
        ],

        // Users
        "~lk[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "view"],
            "middleware" => UserMiddleware::class
        ],
        "~lk[/]report[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "report"],
            "middleware" => UserMiddleware::class
        ],
        "~notifies[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "notifications"],
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

        "GET::~panel[/]users[/]report[/](\d+)[/]?$~" => [
            "controller" => [\Site\Controllers\Admin\UsersController::class, "report"],
            "middleware" => AdminMiddleware::class
        ],

        "GET::~panel[/]objects[/]create[/]?$~" => [
            "controller" => [\Site\Controllers\Admin\ObjectsController::class, "createView"],
            "middleware" => AdminMiddleware::class
        ],
        "POST::~panel[/]objects[/]create[/]?$~" => [
            "controller" => [\Site\Controllers\Admin\ObjectsController::class, "create"],
            "middleware" => AdminMiddleware::class
        ],
        "GET::~panel[/]objects[/]catalog_sell[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Admin\CatalogController::class, "view"],
            "middleware" => AdminMiddleware::class
        ],

        // Objects
        "~id/([^/]+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CardController::class, "view"],
        ],
        "~catalog[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "view"],
        ],
        "~catalog[/]recommendations[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "recommendations"],
            "middleware" => UserMiddleware::class
        ],
        "~catalog[/]recent[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "recent"],
            "middleware" => UserMiddleware::class
        ],
        "~catalog[/]favorites[/]?(\d+)?[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "favorites"],
            "middleware" => UserMiddleware::class
        ],
        "~catalog[/]map[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CatalogController::class, "map"]
        ],

        // API
        "POST::~api[/]address[/]?$~" => [
            "controller" => [\Site\Controllers\DaDataController::class, "view"]
        ],
        "POST::~api[/]objects[/]map[/]view[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "mapRender"]
        ],
        "POST::~api[/]objects[/]map[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "map"]
        ],
        "GET::~api[/]objects[/]recent[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recent"]
        ],
        "GET::~api[/]objects[/]recommendations[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recommendations"],
            "middleware" => UserMiddleware::class
        ],
        "POST::~api[/]objects[/]call[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\VerifyOwnerRequestController::class, "request"],
            "middleware" => PaidUserMiddleware::class
        ],
        "POST::~api[/]objects[/]cancel_call[/](\d+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\VerifyOwnerRequestController::class, "cancel_request"],
            "middleware" => PaidUserMiddleware::class
        ],
        "GET::~api[/]objects[/]call_result[/](\d+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "callResult"],
            "middleware" => PaidUserMiddleware::class
        ],
        "POST::~api[/]objects[/]favorite[/](\d+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "setFavorite"]
        ],
        "POST::~api[/]settings[/](.+)[/]?$~" => [
            "controller" => [\Site\Controllers\User\CookieSettingsController::class, "config"]
        ],
        "POST::~api[/]user[/]checkin-date[/]?$~" => [
            "controller" => [\Site\Controllers\User\UserSettingsController::class, "setPaymentDate"]
        ],
        "POST::~api[/]user[/]filter[/]?$~" => [
            "controller" => [\Site\Controllers\User\UserSettingsController::class, "setFilter"]
        ],

        // Megafon CRM
        "MIXED::~business[/]mcrm[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\MegafonController::class, "request"],
            "middleware" => GuestMiddleware::class
        ],

        // Webhooks
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
        "MIXED::~api[/]zvnk[/]new[/]([^/]+)[/]?$~" => [
            "controller" => [\Site\Controllers\WebHook\ZvonokWebHook::class, "successful_call"]
        ],
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
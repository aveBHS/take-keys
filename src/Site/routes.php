<?php

use Site\Middleware\AdminMiddleware;
use Site\Middleware\GuestMiddleware;
use Site\Middleware\MegafonMiddleware;
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
        "~logout[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "logout"],
            "middleware" => UserMiddleware::class
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
        "GET::~api[/]objects[/]recent[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recent"]
        ],
        "GET::~api[/]objects[/]recommendations[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\ObjectAPIController::class, "recommendations"],
            "middleware" => UserMiddleware::class
        ],

        // Megafon CRM
        "MIXED::~business[/]mcrm[/]?$~" => [
            "controller" => [\Site\Controllers\MegafonController::class, "request"],
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
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
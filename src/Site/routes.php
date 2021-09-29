<?php

use Site\Middleware\GuestMiddleware;
use Site\Middleware\MegafonMiddleware;
use Site\Middleware\UserMiddleware;

return [
    "routes" => [
        "~^[/]?$~" => [
            "controller" => [\Site\Controllers\MainController::class, "view"],
        ],
        "~id/(.+)[/]?$~" => [
            "controller" => [\Site\Controllers\Objects\CardController::class, "view"],
        ],
        "~login[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "view"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~login[/]?$~" => [
            "controller" => [\Site\Controllers\User\LoginController::class, "auth"],
            "middleware" => GuestMiddleware::class
        ],
        "~private[/]?$~" => [
            "controller" => [\Site\Controllers\User\CabinetController::class, "view"],
            "method" => "GET",
            "middleware" => UserMiddleware::class
        ],

        // Objects API
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
            "controller" => [\Site\Controllers\TildaWebHookController::class, "processRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]editRequest[/]?$~" => [
            "controller" => [\Site\Controllers\TildaWebHookController::class, "processRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]removeRequest[/]?$~" => [
            "controller" => [\Site\Controllers\TildaWebHookController::class, "removeRequest"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]payment[/]?$~" => [
            "controller" => [\Site\Controllers\TildaWebHookController::class, "processPayment"],
            "middleware" => GuestMiddleware::class
        ],
        "POST::~whook[/]booking[/]?$~" => [
            "controller" => [\Site\Controllers\TildaWebHookController::class, "booking"],
            "middleware" => GuestMiddleware::class
        ],
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
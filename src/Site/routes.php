<?php

use Site\Middleware\GuestMiddleware;
use Site\Middleware\UserMiddleware;

return [
    "routes" => [
        "~^[/]?$~" => [
            "controller" => [\Site\Controllers\MainController::class, "view"],
        ],
        "~id/(\d+)[/]?$~" => [
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
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
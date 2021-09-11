<?php

use Site\Middleware\GuestMiddleware;
use Site\Middleware\UserMiddleware;

return [
    "routes" => [
        "~^[/]?$~" => [\Site\Controllers\MainController::class, "view"],
        "~id/(\d+)[/]?$~" => [\Site\Controllers\Objects\CardController::class, "view"],
        "~login[/]?$~" => [\Site\Controllers\User\LoginController::class, "view", GuestMiddleware::class],
        "~private[/]?$~" => [\Site\Controllers\User\CabinetController::class, "view", UserMiddleware::class]
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
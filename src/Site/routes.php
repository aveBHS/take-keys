<?php

return [
    "defaultMiddleware" => \Site\Middleware\GuestMiddleware::class,
    "routes" => [
        "~^$~" => [\Site\Controllers\MainController::class, "index"],
        "~id/(\d+)$~" => [\Site\Controllers\Objects\CardController::class, "view"]
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"],
        500 => [\Site\Controllers\Exceptions\InternalServerErrorController::class, "view"]
    ]
];
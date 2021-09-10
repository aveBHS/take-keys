<?php

return [
    "routes" => [
        "~^$~" => [\Site\Controllers\MainController::class, "index"]
    ],
    "exceptions" => [
        404 => [\Site\Controllers\Exceptions\NotFoundController::class, "view"]
    ]
];
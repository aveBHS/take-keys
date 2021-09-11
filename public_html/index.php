<?php

use Site\Core\HttpRequest;

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});
require_once __DIR__ . "/../src/Site/helpers.php";

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . "/../src/Site/routes.php";

$request = new HttpRequest($_GET['route']);

foreach ($routes['routes'] as $regex => $render)
{
    $fetch = $request->fetchRoute($regex);
    if(!is_null($fetch)){
        if($render[2]) {
            $middleware = $render[2];
            middleware(new $middleware(), $request, function ($request, $controller, $controllerMethod, $args) {
                render($request, $controller, $controllerMethod, $args);
            }, [$request, $render[0], $render[1], $fetch]);
        } else {
            render($request, $render[0], $render[1], $fetch);
        }
        return;
    }
}

render($request, $routes['exceptions'][404][0], $routes['exceptions'][404][1]);

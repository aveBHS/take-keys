<?php

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . $className . '.php';
});
require __DIR__ . "/../src/Site/helpers.php";

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . "/../src/Site/routes.php";

$route_found = false;
foreach ($routes['routes'] as $regex => $render)
{
    preg_match($regex,$route, $match);
    if(!empty($match)){
        render($render[0], $render[1]);
        return;
    }
}

render($routes['exceptions'][404][0], $routes['exceptions'][404][1]);

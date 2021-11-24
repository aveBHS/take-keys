<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods', "GET, POST, PUT, DELETE");
mb_internal_encoding('UTF-8');
session_start();

use Site\Core\AuthService;
use Site\Core\HttpRequest;

spl_autoload_register(function (string $className) {
    require_once __DIR__ . '/../src/' . str_replace("\\", "/", $className) . '.php';
});
require_once __DIR__ . "/../src/Site/helpers.php";

$db = require_once __DIR__ . "/../src/Site/database.php";

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . "/../src/Site/routes.php";

$request = new HttpRequest($_GET['route']);
$auth = new AuthService($request);

$request->requestLog();

foreach ($routes['routes'] as $regex => $render)
{
    $fetch = $request->fetchRoute($regex);
    if(!is_null($fetch)){
        if($render['middleware']) {
            $middleware = $render['middleware'];
            middleware(new $middleware(), $request, function ($request, $controller, $controllerMethod, $args) {
                render($request, $controller, $controllerMethod, $args);
            }, [$request, $render['controller'][0], $render['controller'][1] ?? 'view', $fetch]);
        } else {
            render($request, $render['controller'][0], $render['controller'][1] ?? 'view', $fetch);
        }
        return;
    }
}

render($request, $routes['exceptions'][404][0], $routes['exceptions'][404][1]);

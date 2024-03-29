<?php

use Site\Core\TelegramNotifyService;
use Site\Middleware\Middleware;
use Site\Models\LogModel;

function render($request, $className, $classMethod, $args = [])
{
    $controller = new $className;
    $controller->$classMethod($request, $args);
}

function middleware(Middleware $middleware, $request, $callback, $args = [])
{
    $middleware->handle($request, $callback, $args);
}

function env($paramName)
{
    $env = [];
    $paramName = strtolower($paramName);
    if ($file = fopen($_SERVER['DOCUMENT_ROOT'] . "/../.env", "r")) {
        while(!feof($file)) {
            $line = fgets($file);
            if(empty(trim($line)) || substr(trim($line), 0, 2) == "//")
                continue;
            $param = explode("=", $line);
            $env[strtolower(trim($param[0]))] = rtrim($param[1]);
        }
        fclose($file);
    }
    if(array_key_exists($paramName, $env)){
        switch ($env[$paramName])
        {
            case "TRUE":
                return true;
            case "FALSE":
                return false;
        }
        return $env[$paramName];
    }
    return Null;
}

function getTableName($className): string
{
    $className = explode("\\", $className);
    $className = $className[count($className)-1];
    if(mb_substr($className, strlen($className) - 5) == "Model")
        $className = mb_substr($className, 0, -5);
    $className = strtolower($className);
    switch (mb_substr($className, 0, -2))
    {
        case "ss":
        case "sh":
        case "ch":
            return $className."es";
        case "fe":
            return mb_substr($className, 0, -2)."ves";
        default:
            switch (mb_substr($className, 0, -1))
            {
                case "s":
                case "x":
                case "o":
                    return $className."es";
                case "y":
                    return mb_substr($className, 0, -1)."ies";
                case "f":
                    return mb_substr($className, 0, -2)."ves";
                default:
                    return $className."s";
            }
    }
}

function view(string $viewName, array $args = [])
{
    foreach ($args as $argName => $argValue)
    {
        $$argName = $argValue;
    }
    define("VIEW_PATH", $_SERVER['DOCUMENT_ROOT'] . "/../src/Site/Views/");
    $viewName = str_replace(".", "/", $viewName);
    if(mb_substr($viewName, 0, -4) != ".php")
        $viewName .= ".php";

    ob_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/../src/Site/Views/$viewName";
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function cuteDate($date)
{
    $today = date('d.m.Y', time());
    $yesterday = date('d.m.Y', time() - 86400);
    $dbDate = date('d.m.Y', strtotime($date));
    $dbTime = date('H:i', strtotime($date));

    switch ($dbDate)
    {
        case $today : $output = 'Сегодня в '. $dbTime; break;
        case $yesterday : $output = 'Вчера в '. $dbTime; break;
        default : $output = $dbDate;
    }
    return $output;
}

function isNew($date): bool
{
    $today = date('d.m.Y', time());
    $yesterday = date('d.m.Y', time() - 86400);
    $dbDate = date('d.m.Y', strtotime($date));
    $dbTime = date('H:i', strtotime($date));

    switch ($dbDate)
    {
        case $today :
        case $yesterday : return true;
        default : return false;
    }
}

function getPhone($phone)
{
    if (is_null($phone)) return null;
    $phone = trim($phone);
    $phone = str_replace(" ", "", $phone);
    $phone = str_replace("-", "", $phone);
    $phone = str_replace("+", "", $phone);
    $phone = str_replace("(", "", $phone);
    $phone = str_replace(")", "", $phone);
    if ($phone[0] == "8") $phone = "7" . substr($phone, 1);
    return $phone;
}

function bugReport($exception, $message=null)
{
    $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
    $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"),
        var_export($message ?? $exception->getMessage(), true) . "\n\n" . var_export(debug_backtrace(), true));
}

function filter($regex, $value): bool
{
    preg_match('/^'.$regex.'$/', $value, $match);
    return !empty($match);
}

function userLog($title, $text, $user_id=Null)
{
    try {
        global $auth;
        $log = new LogModel();
        $log->title = $title;
        $log->content = $text;
        $log->user_id = $user_id ?? $auth()->id ?? 0;
        $log->save();
    } catch (Exception $exception){
        bugReport($exception);
    }
}

function coordsDistance($lat1, $long1, $lat2, $long2){
    $lat1 = $lat1 * M_PI / 180;
    $lat2 = $lat2 * M_PI / 180;
    $long1 = $long1 * M_PI / 180;
    $long2 = $long2 * M_PI / 180;

    $y = sqrt(pow(cos($lat2) * sin($long2 - $long1), 2) + pow(cos($lat1) * sin($lat2) - sin($lat1) * cos($lat2) * cos($long2 - $long1), 2));
    $x = sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($long2 - $long1);

    return atan2($y, $x) * EARTH_RADIUS;
}

function calcCircle($lat, $lng, $length): array
{
    $lat_length = coordsDistance(1, $lng, 2, $lng);
    $lng_length = coordsDistance($lat, 1, $lat, 2);

    $deltaLat = $length / $lat_length;
    $deltaLng = $length / $lng_length;

    return [
        [$lat + $deltaLat, $lng],
        [$lat, $lng + $deltaLng],
        [$lat, $lng - $deltaLng],
        [$lat - $deltaLat, $lng]
    ];
}

function mysqlNOW(){
    return date('Y-m-d H:i:s');
}
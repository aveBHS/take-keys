<?php

use Site\Middleware\Middleware;

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
    $className = strtolower($className[count($className)-1]);
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
        if(is_array($argValue))
            $$argName = (object) $argValue;
        else
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
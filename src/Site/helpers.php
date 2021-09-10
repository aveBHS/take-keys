<?php

function render($className, $classMethod)
{
    $controller = new $className;
    echo $controller->$classMethod();
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
        return $env[$paramName];
    }
    return Null;
}

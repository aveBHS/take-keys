<?php

function render($className, $classMethod, $args = [])
{
    $controller = new $className;
    echo $controller->$classMethod(...$args);
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
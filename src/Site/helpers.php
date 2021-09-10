<?php

function render($className, $classMethod){
    $controller = new $className;
    echo $controller->$classMethod();
}
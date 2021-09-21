<?php

use Site\Controllers\Exceptions\InternalServerErrorController;
use Site\Core\HttpRequest;

require_once $_SERVER['DOCUMENT_ROOT'] . "/../src/Site/helpers.php";

$link = mysqli_connect(
    env("DB_HOST"),
    env("DB_USER"),
    env("DB_PASSWD"),
    env("DB_BASE")
);

if(!$link){
    if(env("debug")){
        echo($link->error);
    }
    render(new HttpRequest(), InternalServerErrorController::class, "view");
    die();
}

mysqli_set_charset($link, "utf8");

return $link;
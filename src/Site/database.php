<?php

use Site\Controllers\Exceptions\InternalServerErrorController;

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
    render(InternalServerErrorController::class, "view");
    die();
}

return $link;
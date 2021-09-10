<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../src/Site/helpers.php";

return mysqli_connect(
    env("DB_HOST"),
    env("DB_USER"),
    env("DB_PASSWD"),
    env("DB_BASE")
);
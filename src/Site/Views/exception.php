<?php
/**
 * @var object $error
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$error->code?></title>
    <style>
        html, body{
            height: 100%;
            margin: 0;
        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-family: Arial, serif;
        }
    </style>
</head>
<body>
<div>
    <h1><?=$error->code?></h1>
    <h3><?=$error->message?></h3>
</div>
</body>
</html>

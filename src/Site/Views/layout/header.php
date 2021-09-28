<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <!-- <base href="/"> -->

    <title><?=$_page_title ?? "Take Keys"?></title>
    <meta name="description" content="<?=$_page_desc ?? "Take Keys"?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="/images/favicon.svg">
    <meta property="og:image" content="/images/favicon.svg">

    <link rel="stylesheet" href="/css/app.min.css?5">

    <!-- Chatra {literal} -->
    <script>
        (function(d, w, c) { w.ChatraID = 'FZAHKeBARdKZ8PQeu'; var s = d.createElement('script'); w[c] = w[c] || function() { (w[c].q = w[c].q || []).push(arguments); }; s.async = true; s.src = 'https://call.chatra.io/chatra.js'; if (d.head) d.head.appendChild(s); })(document, window, 'Chatra');
    </script>
    <style>
        #chatra:not(.chatra--expanded) {
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none;
            transition: none;
        }
    </style>
    <!-- /Chatra {/literal} -->

    <script src="https://api-maps.yandex.ru/2.1/?apikey=<?=env("yandex_maps_key")?>&lang=ru_RU" type="text/javascript"></script>

</head>

<body class="<?=$_body_class ?? ""?>">

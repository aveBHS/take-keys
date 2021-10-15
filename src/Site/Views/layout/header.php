<?php global $auth; ?>
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

<header>
    <div class="topline py-4">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a class="logo logo-footer" href="/">
                        <img src="/images/icons/logo.svg" alt="Take Keys">
                    </a>
                </div>
                <div class="col-auto ms-auto d-lg-none">
                    <button class="navbar-toggler hamburger hamburger--spin" type="button" data-bs-toggle="collapse" data-bs-target="#topline-menu">
							<span class="hamburger-box">
								<span class="hamburger-inner"></span>
							</span>
                    </button>
                </div>
                <div class="w-100 d-lg-none"></div>
                <div class="col collapse topline__mobile" id="topline-menu">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-auto mx-auto mt-3 mt-lg-0">
                            <ul class="topline__menu">
                                <li><a href="/about">Как это работает</a></li>
                                <li><a href="/catalog">Каталог</a></li>
                                <li><a href="/help">Справочный центр</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto">
                            <div class="row">
                                <?php if(is_null($auth())) { ?>
                                    <div class="col-12 col-lg-auto">
                                        <a href="/join" class="btn btn-primary topline__btn">Регистрация</a>
                                    </div>
                                    <div class="col-12 col-lg-auto">
                                        <a href="/login" class="btn btn-dark topline__btn">Войти</a>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 col-lg-auto">
                                        <a href="/lk" class="btn btn-primary topline__btn">Личный кабинет</a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="content">
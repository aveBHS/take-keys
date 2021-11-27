<?php
/**
 * @var string $_page_title
 * @var string $_page_desc
 * @var string $_page_img
 * @var array $_custom_button
 */
global $auth;
$_show_favorites = !is_null($auth());
?>
<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <!-- <base href="/"> -->

    <title><?=$_page_title ?? "Take Keys"?></title>
    <meta name="description" content="<?=$_page_desc ?? "Take Keys"?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="/images/favicon.svg">

    <meta property="og:title" content="<?=$_page_title?>">
    <meta property="og:description" content="<?=$_page_desc?>">
    <meta property="og:image" content="<?=$_page_img??'/images/favicon.svg'?>">

    <link rel="stylesheet" href="/css/app.min.css?5">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(85688374, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });

        <?php if(!is_null($auth())) { ?>
        ym(85688374, 'setUserID', <?=$auth()->id?>);
        <?php } ?>
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/85688374" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</head>

<body class="<?=$_body_class ?? ""?>">

<header>
    <div class="topline py-2 py-lg-3">
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
                                <li><a href="https://take-keys.com/">О сервисе</a></li>
                                <li><a href="/catalog">Каталог</a></li>
                                <?=$_show_favorites?'<li><a href="/catalog/favorites">Избранные</a></li>':''?>
                                <li><a href="https://take-keys.com/help">Справочный центр</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto">
                            <div class="row">
                                <?php if (!is_null($_custom_button)) { ?>
                                    <div class="col-12 col-lg-auto">
                                        <a href="/<?=$_custom_button[0]?>" class="btn btn-dark topline__btn"><?=$_custom_button[1]?></a>
                                    </div>
                                <?php } else if(is_null($auth())) { ?>
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
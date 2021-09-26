<?php
/**
 * @var object $object
 * @var array $images
 * @var string VIEW_PATH
 * @var bool $purchased
 **/
$page_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$page_url = explode('?', $page_url);
$page_url = $page_url[0];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <!-- <base href="/"> -->

    <title><?=$object->title?><?=strlen($object->title) > 0 ? " | " : ""?>Take Keys</title>
    <meta name="description" content="<?=substr($object->description, 0, 100)?>...">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="icon" href="/images/favicon.png">

    <meta property="og:title" content="<?=$object->title?><?=strlen($object->title) > 0 ? " | " : ""?>Take Keys">
    <meta property="og:description" content="<?=substr($object->description, 0, 100)?>...">
    <meta property="og:image" content="<?=$images[0]->path?>">
    <meta property="og:url" content="<?=$page_url?>">

    <link rel="stylesheet" href="/css/app.min.css">
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
</head>

<body style="padding-bottom: 96px;">

<div class="d-none d-lg-block">
    <div class="container">
        <div class="breadcrumbs h-48">
            <a>Каталог</a>/Аренда недвижимости
        </div>
    </div>
</div>
<div class="item">
    <div class="item__top-menu-mobile">
        <i class="icon"><img src="/images/icons/arrow-left-dark.svg"></i>
        <button onclick="Chatra('openChat', true)" class="btn btn-primary btn-icon btn-chat-top ms-3">
            <i class="icon"><img src="/images/icons/chat-16.svg"></i>
        </button>
        <i class="icon ms-auto"><img src="/images/icons/search.svg"></i>
        <i class="icon"><img src="/images/icons/share.svg"></i>
        <i class="icon"><img src="/images/icons/heart.svg"></i>
    </div>
    <div class="container">
        <div class="row position-relative">
            <div class="col-lg-8 col-xxl-9 pb-lg-5 order-lg-3">
                <!-- Slider main container -->
                <div class="item-slider w-mobile-100 mt-2 mt-lg-4" data-swiper-speed="700">

                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php
                        foreach($images as $image){ ?>
                            <div class="swiper-slide item-slider__slide" data-swiper-autoplay="20000">
                                <div class="item-slider__bg ratio" data-swiper-parallax="40%"
                                     style="background-image: url('<?=$image->path?>');" data-thumb="<?=$image->path?>"></div>
                            </div>
                        <?php }
                        ?>
                    </div>

                    <div class="swiper-pagination-counter mb-2">
                        <span class="current">1</span>/
                        <span class="total"></span>
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"><i class="icon"><img src="/images/icons/arrow-left.svg"></i></div>
                    <div class="swiper-button-next"><i class="icon"><img src="/images/icons/arrow-right.svg"></i></div>

                    <div class="item__tags">
                        <span class="btn-colored bg-danger">Лучшая цена</span>
                        <span class="btn-colored bg-primary">Новое</span>
                        <span class="btn-colored bg-warning">Горячее</span>
                        <span class="btn-colored bg-info">Рекомендуемые</span>
                        <?php if($object->status > 0) { ?>
                            <span class="btn-colored bg-white text-dark">На проверке</span>
                        <?php } ?>
                    </div>

                </div>

                <div class="slider__gallery clearfix">

	<span class="slider__gallery__thumb icon-photo">
        <img class="me-2" src="/images/icons/photo.svg"><?=count($images)?>
	</span>
                    <span class="swiper-pagination-custom"></span>
                </div>
            </div>

            <div class="col-lg-8 col-xxl-9 order-lg-1">
                <h1 class="h1 item__title my-2 my-lg-0"><?=$object->title?></h1>
                <div class="d-none d-lg-block">
                    <div class="row gx-0 align-items-center">
                        <div class="col-auto">
                            <span class="item__date me-3"><?=cuteDate($object->created)?></span>
                        </div>
                        <div class="col-auto">
                            <span class="icon"><img src="/images/icons/eye.svg"></span>
                        </div>
                        <div class="col-auto">
                            <span class="views-counter">0 просмотров</span>
                        </div>
                        <div class="col-auto ms-auto">
                            <button class="btn btn-outline-light btn-icon">
                                <i class="icon"><img src="/images/icons/share.svg"></i>
                            </button>
                        </div>
                        <div class="col-auto ms-2">
                            <button class="btn btn-outline-light btn-icon">
                                <i class="icon"><img src="/images/icons/heart.svg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xxl-3 order-lg-2">

                <div class="row">
                    <div class="col-auto col-lg-12">
                        <div class="item__price h-64"><?=$object->cost?> ₽/мес.</div>
                    </div>
                    <div class="col-auto col-lg-12">
                        <div class="h-48 text-secondary mb-3"><s><?=($object->cost)*1.25?> ₽</s></div>
                    </div>
                </div>


                <div class="position-relative w-mobile-100">
                    <button class="btn btn-light btn-icon w-100 item__londrent_open collapsed" data-bs-toggle="collapse" data-bs-target=".item__londrent">
                        <div class="d-flex align-items-center">
                            <i class="icon"><img src="/images/icons/info-circle.svg"></i>
                            <span>Долгострочная аренда</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                    <div class="item__londrent collapse">
                        <div class="d-flex mt-3 mb-4">
                            <div class="ps-3">
                                <div class="fw-semibold">Долгострочная аренда</div>
                                <div class="fw-normal text-nowrap"><?=$object->cost?> ₽</div>
                            </div>
                            <i class="icon ms-auto"><img src="/images/icons/check.svg"></i>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="ps-3">
                                <div class="fw-semibold">Посуточная аренда</div>
                                <div class="fw-normal text-nowrap"><span style="color:silver">Не указано</span></div>
                            </div>
                            <!--i class="icon ms-auto"><img src="/images/icons/check.svg"></i-->
                        </div>
                        <div class="d-flex mb-4">
                            <div class="ps-3">
                                <div class="fw-semibold">Продажа</div>
                                <div class="fw-normal text-nowrap"><span style="color:silver">Не указано</span></div>
                            </div>
                            <!--i class="icon ms-auto"><img src="/images/icons/check.svg"></i-->
                        </div>
                        <div class="px-3 fs-14 fw-normal mb-2">
                            *Информация указана на основание рыночной статистике. Окончательное решение о стоимости и типе сделки, а также удобства определяет собственник.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xxl-3 order-lg-4 item__contact-wrp">
                <div class="item__contact">
                    <?php if($purchased) { ?>
                        <a href="tel:<?=$object->phones?>">
                            <button class="btn btn-48 btn-primary w-100 mb-3">
                                <?= preg_replace(
                                    '/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/',
                                    '+\1 (\2) \3-\4-\5',
                                    (string) $object->phones
                                ) ?>
                            </button>
                        </a>
                        <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark w-100 mb-4">Бронировать</button></a>
                    <?php } else { ?>
                        <form action="https://take-keys.com/go-buy" method="post">
                            <button class="btn btn-48 btn-primary w-100 mb-3">Связаться</button>
                            <button class="btn btn-48 btn-dark w-100 mb-4">Бронировать</button>
                        </form>
                    <?php } ?>
                    <div class="item__owner"> <!-- 'active' class для онлайна-->
                        <div class="item__owner__avatar">
                            <img src="/images/dist/ava.png" alt="Чат с владельцем">
                        </div>
                        <div class="ms-3 text-start">
                            <div class="fw-semibold">
                                <?php if($purchased) {
                                    echo !empty($object->name) ? $object->name : "Имя не указано";
                                } else { ?>
                                    Собственник
                                <?php } ?>
                            </div>
                            <div class="fw-normal fs-14">Частное лицо</div>
                        </div>
                    </div>
                    <!--div class="mt-5">
                        <button class="btn btn-primary btn-icon btn-bell">
                            <i class="icon"><img src="/images/icons/bell.svg"></i>
                        </button>
                    </div>
                    <div class="fs-18 mt-2">
                        Уведомлять о похожих<br/>вариантах
                    </div>
                    <button class="btn btn-48 fs-14 fw-normal">Включить</button-->
                </div>
            </div>

            <div class="col-lg-8 col-xxl-9 order-lg-5">
                <div class="row mt-lg-5">
                    <?php if(!empty($object->metroSlug)) { ?>
                    <div class="col-12 order-lg-2">
                        <div class="row g-0">
                            <div class="col-auto item__metro">
                                <img class="me-2" src="/images/icons/metro.svg"><?=$object->metroSlug?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-12 order-lg-1">
                        <div class="row">
                            <div class="col-lg-auto">
                                <div class="h-48 text-secondary">
                                    <?=$object->address?>
                                </div>
                            </div>
                            <!--div class="col-lg-auto ms-auto">
                                <div class="w-mobile-100">
                                    <button class="btn btn-icon w-100 collapsed" data-bs-toggle="collapse" data-bs-target=".map-collapse">
                                        <div class="d-flex align-items-center">
                                            Показать на карте<i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                                        </div>
                                    </button>
                                </div>
                            </div-->
                        </div>
                    </div>
                </div>

                <div class="collapse map-collapse w-mobile-100">
                    <div class="map mt-lg-4 pb-lg-5" style="background-image: url('/images/dist/map.jpg');"></div>
                </div>


                <div class="h1 item__desc-title">О доме</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-2">
                        <div class="d-flex align-items-center">
                            <span class="h1">О доме</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-2 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <dl class="item__desc-list">
                        <dt>Тип дома</dt><?=!empty($object->materialSlug) ? '<dd style="text-transform: capitalize;">'.$object->materialSlug.'</dd>' : '<dd style="color:silver">Не указано</dd>' ?>
                        <dt>Год постойки</dt><dd style="color:silver">Не указано</dd>
                        <dt>Тип перекрытий</dt><dd style="color:silver">Не указано</dd>
                        <dt>Подъезд</dt><dd style="color:silver">Не указано</dd>
                        <dt>Аварийность</dt><dd style="color:silver">Не указано</dd>
                        <dt>Лифт</dt><dd style="color:silver">Не указано</dd>
                        <dt>Отопление</dt><dd style="color:silver">Не указано</dd>
                        <dt>Мусоропровод</dt><dd style="color:silver">Не указано</dd>
                        <dt>Консьерж-сервис</dt><dd style="color:silver">Не указано</dd>
                    </dl>
                </div>


                <div class="h1 item__desc-title">Описание</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-1">
                        <div class="d-flex align-items-center">
                            <span class="h1">Описание</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-1 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <?=trim($object->description)?>
                </div>


                <div class="h1 item__desc-title">О квартире</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-3">
                        <div class="d-flex align-items-center">
                            <span class="h1">О квартире</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-3 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <dl class="item__desc-list">
                        <dt>Общая площадь, м²</dt><?=!empty($object->sq) ? '<dd>'.$object->sq.'</dd>' : '<dd style="color:silver">Не указано</dd>' ?>
                        <dt>Тип комнат</dt><dd style="color:silver">Не указано</dd>
                        <dt>Жилая, м²</dt><dd style="color:silver">Не указано</dd>
                        <dt>Ремонт</dt><dd style="color:silver">Не указано</dd>
                        <dt>Этаж в доме</dt><?=!empty($object->floor) ? '<dd>'.$object->floor.'</dd>' : '<dd style="color:silver">Не указано</dd>' ?>
                        <dt>Вид из окна</dt><dd style="color:silver">Не указано</dd>
                        <dt>Этажей в доме</dt><?=!empty($object->floors) ? '<dd>'.$object->floors.'</dd>' : '<dd style="color:silver">Не указано</dd>' ?>
                    </dl>
                </div>


                <div class="h1 item__desc-title">Дополнительные сведения</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-4">
                        <div class="d-flex align-items-center">
                            <span class="h1">Дополнительные сведения</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-4 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <div class="row row-cols-1 row-cols-lg-3 g-3">
                        <div class="col">
                            Коммунальные услуги
                            <div class="item__addictional-info text-primary">Включено в стоимость</div>
                            <div class="fs-12">*Окончательную стоимость уточняйте у владельца</div>
                        </div>
                        <div class="col">
                            Право собственности
                            <div class="item__addictional-info">Собственик</div>
                        </div>
                        <div class="col">
                            Статус проверки
                            <span class="float-end cursor-pointer"><img src="/images/icons/info-circle.svg"></span>
                            <?php if($object->status > 0) { ?>
                                <div class="item__addictional-info">Проверяется</div>
                            <?php } else { ?>
                                <div class="item__addictional-info text-primary">Пройдено</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!--div class="h1 item__desc-title mb-0">Вас может заитересовать</div>
                <div class="h-48">
                    <div class="text-secondary fw-normal fs-14">Изменить параметры поиска</div>
                </div>
                <div class="catalog">
                    <div class="row gx-2 flex-nowrap scroll-x">
                        <div class="col-9 col-lg-5">
                            <div class="catalog__item">
                                <div class="catalog__item__img ratio" style="background-image: url('images/dist/item-slide-1.jpg');">
                                    <div class="item__tags">
                                        <span class="btn-colored bg-danger">Лучшая цена</span>
                                        <span class="btn-colored bg-warning">Горячее</span>
                                    </div>
                                </div>
                                <div class="catalog__item__info">
                                    <div class="catalog__item__title">
                                        Аренда квартиры на длительный срок в новострое
                                    </div>
                                    <div class="catalog__item__price">
                                        <span class="catalog__item__price-new">110 000 ₽/мес.</span>
                                        <s class="catalog__item__price-old">150 000 ₽</s>
                                    </div>
                                    <div class="catalog__item__address">Москва, улица Большая Полянка, 28</div>
                                    <div class="catalog__item__param d-none d-lg-flex">
                                        <i class="icon"><img src="/images/icons/home.svg"></i>1
                                        <i class="ms-4 icon"><img src="/images/icons/box.svg"></i>44 м²
                                    </div>
                                    <div class="row gx-0 justify-content-between">
                                        <div class="col-auto order-lg-2 ms-lg-auto">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/share.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-auto order-lg-2">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/heart.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-auto order-lg-2 d-lg-none">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/plus.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 col-lg-auto order-lg-1">
                                            <button class="btn btn-outline-dark catalog__item__btn-show">Смотреть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 col-lg-5">
                            <div class="catalog__item">
                                <div class="catalog__item__img ratio" style="background-image: url('images/dist/item-slide-1.jpg');">
                                    <div class="item__tags">
                                        <span class="btn-colored bg-primary">Новое</span>
                                        <span class="btn-colored bg-info">Рекомендуемые</span>
                                    </div>
                                </div>
                                <div class="catalog__item__info">
                                    <div class="catalog__item__title">
                                        Аренда квартиры на длительный срок в новострое
                                    </div>
                                    <div class="catalog__item__price">
                                        <span class="catalog__item__price-new">110 000 ₽/мес.</span>
                                        <s class="catalog__item__price-old">150 000 ₽</s>
                                    </div>
                                    <div class="catalog__item__address">Москва, улица Большая Полянка, 28</div>
                                    <div class="catalog__item__param d-none d-lg-flex">
                                        <i class="icon"><img src="/images/icons/home.svg"></i>1
                                        <i class="ms-4 icon"><img src="/images/icons/box.svg"></i>44 м²
                                    </div>
                                    <div class="row gx-0 justify-content-between">
                                        <div class="col-auto order-lg-2 ms-lg-auto">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/share.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-auto order-lg-2">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/heart.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-auto order-lg-2 d-lg-none">
                                            <button class="btn btn-outline-light btn-icon">
                                                <i class="icon"><img src="/images/icons/plus.svg"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 col-lg-auto order-lg-1">
                                            <button class="btn btn-outline-dark catalog__item__btn-show">Смотреть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-auto ms-auto order-lg-2">
                            <a href="#" class="btn btn-icon">
                                <div class="d-flex align-items-center">
                                    Перейти в каталог<i class="icon ms-auto"><img src="/images/icons/arrow-big-right.svg"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-auto order-lg-1">
                            <div class="pagination">
                                <a href="#" class="btn pagination__item"><img src="/images/icons/arrow-left-dark.svg"></a>
                                <a href="#" class="btn pagination__item">2</a>
                                <a href="#" class="btn pagination__item active">3</a>
                                <a href="#" class="btn pagination__item">4</a>
                                <a href="#" class="btn pagination__item"><img src="/images/icons/arrow-right-dark.svg"></a>
                            </div>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>

</div>

<div class="item__fixed-buttons p-3">
    <?php if($purchased) { ?>
        <a href="tel:<?=$object->phones?>" style="padding-top: 12px;" class="btn btn-48 btn-primary">
            <?= preg_replace(
                '/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/',
                '+\1 (\2) \3-\4-\5',
                (string) $object->phones
            ) ?>
        </a>
        <a href="https://take-keys.com/booking" style="padding-top: 12px;" class="btn btn-48 btn-dark">Бронировать</a>
    <?php } else { ?>
        <a href="https://take-keys.com/go-buy" class="btn btn-48 btn-primary" style="padding-top: 12px;">Связаться</a>
        <a href="https://take-keys.com/go-buy" class="btn btn-48 btn-dark" style="padding-top: 12px;">Бронировать</a>
    <?php } ?>
</div>
<button onclick="Chatra('openChat', true)" class="btn btn-warning btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>




<script src="/js/app.min.js"></script>

</body>
</html>
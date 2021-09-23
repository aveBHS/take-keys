<?php
/**
 * @var object $object
 * @var array $images
 * @var string VIEW_PATH
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

</head>

<body>

<div class="d-none d-lg-block">
    <div class="container">
        <div class="breadcrumbs h-48">
            <a>Каталог</a>/Аренда недвижимости
        </div>
    </div>
</div>
<div class="item">
    <div class="container pb-lg-5">
        <div class="row">
            <div class="col-lg-8 col-xxl-9">
                <div class="d-none d-lg-block">
                    <h1 class="h1 item__title"><?=$object->title?></h1>
                    <div class="row gx-0 align-items-center">
                        <div class="col-auto">
                            <span class="item__date me-3">Сегодня, в 12:03</span>
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
                <!-- Slider main container -->
                <div class="item-slider w-mobile-100 mt-4" data-swiper-speed="1000">

                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php
                        foreach($images as $image){ ?>
                            <div class="swiper-slide item-slider__slide" data-swiper-autoplay="20000">
                                <div class="item-slider__bg ratio ratio-16x9" data-swiper-parallax="40%"
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
                        <span class="btn-colored bg-danger">Лучная цена</span>
                        <span class="btn-colored bg-primary">Новое</span>
                        <span class="btn-colored bg-warning">Горячее</span>
                        <span class="btn-colored bg-info">Рекомендуемое</span>
                    </div>

                </div>

                <div class="slider__gallery clearfix">

	<span class="slider__gallery__thumb icon-photo">
		<img class="me-2" src="/images/icons/photo.svg">10
	</span>
                    <span class="swiper-pagination-custom"></span>
                </div>
            </div>
            <div class="col-lg-4 col-xxl-3">
                <h1 class="h1 item__title d-lg-none my-2"><?=$object->title?></h1>

                <div class="row">
                    <div class="col-auto col-lg-12">
                        <div class="item__price h-64"><?=$object->cost?> ₽/мес.</div>
                    </div>
                    <div class="col-auto col-lg-12">
                        <div class="h-48 text-secondary mb-3"><s><?=$object->cost?> ₽</s></div>
                    </div>
                </div>


                <div class="mb-lg-5 w-mobile-100">
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
                                <div class="fw-normal text-nowrap">? ₽</div>
                            </div>
                            <i class="icon ms-auto"><img src="/images/icons/check.svg"></i>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="ps-3">
                                <div class="fw-semibold">Продажа</div>
                                <div class="fw-normal text-nowrap">? ₽</div>
                            </div>
                            <i class="icon ms-auto"><img src="/images/icons/check.svg"></i>
                        </div>
                        <div class="px-3 fs-14 fw-normal mb-2">
                            *Информация указана на основание рыночной статистике. Окончательное решение о стоимости и типе сделки, а также удобства определяет собственник.
                        </div>
                    </div>
                </div>
                <div class="item__contact">
                    <button class="btn btn-48 btn-primary w-100 mb-3">Связаться с владельцем</button>
                    <button class="btn btn-48 btn-dark w-100 mb-5">Бронировать</button>
                    <button class="btn btn-primary btn-icon btn-bell">
                        <i class="icon"><img src="/images/icons/bell.svg"></i>
                    </button>
                    <div class="fs-18 mt-2">
                        Уведомлять о похожих<br/>вариантах
                    </div>
                    <button class="btn btn-48 fs-14 fw-normal">Включить</button>
                </div>
                <div class="item__fixed-buttons p-3">
                    <button class="btn btn-48 btn-primary">Связаться</button>
                    <button class="btn btn-48 btn-dark">Бронировать</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-lg-5">
        <div class="row">
            <div class="col-lg-8 col-xxl-9">

                <div class="row">
                    <div class="col-12 order-lg-2">
                        <div class="row g-0">
                            <div class="col-auto item__metro">
                                <img class="me-2" src="/images/icons/metro.svg">Арбатская
                            </div>
                            <div class="col-auto item__metro">
                                <img class="me-2" src="/images/icons/metro.svg">Академическая
                            </div>
                            <div class="col-auto item__metro">
                                <img class="me-2" src="/images/icons/metro.svg">Авиамоторная
                            </div>
                        </div>
                    </div>
                    <div class="col-12 order-lg-1">
                        <div class="row">
                            <div class="col-lg-auto">
                                <div class="h-48 text-secondary">
                                    <?=$object->address?>
                                </div>
                            </div>
                            <div class="col-lg-auto ms-auto">
                                <div class="w-mobile-100">
                                    <button class="btn btn-icon w-100 collapsed" data-bs-toggle="collapse" data-bs-target=".map-collapse">
                                        <div class="d-flex align-items-center fw-semibold">
                                            Показать на карте<i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse map-collapse w-mobile-100">
                    <div class="map mt-lg-4 pb-lg-5" style="background-image: url('/images/dist/map.jpg');"></div>
                </div>

                <div class="h1 item__desc-title">О доме</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-1">
                        <div class="d-flex align-items-center">
                            <span class="h1">О доме</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-1 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <?=trim($object->description)?>
                </div>


                <div class="h1 item__desc-title">Описание</div>
                <div class="w-mobile-100 item__desc-spoiler">
                    <button class="btn btn-light btn-icon w-100" data-bs-toggle="collapse" data-bs-target=".item__desc-2">
                        <div class="d-flex align-items-center">
                            <span class="h1">Описание</span>
                            <i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                        </div>
                    </button>
                </div>
                <div class="item__desc-2 pb-lg-5 mt-2 mt-lg-0 d-lg-block collapse show">
                    <dl class="item__desc-list">
                        <dt>Тип дома</dt><dd>Монолитный</dd>
                        <dt>Год постойки</dt><dd>2021</dd>
                        <dt>Тип перекрытий</dt><dd>Железобетонный</dd>
                        <dt>Подъезд</dt><dd>1</dd>
                        <dt>Аварийность</dt><dd>Нет</dd>
                        <dt>Лифт</dt><dd>3</dd>
                        <dt>Отопление</dt><dd>Центральное</dd>
                        <dt>Мусоропровод</dt><dd>Есть</dd>
                        <dt>Консьерж-сервис</dt><dd>Есть</dd>
                    </dl>
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
                        <dt>Общая площадь, м²</dt><dd>79</dd>
                        <dt>Тип комнат</dt><dd>Изолированные</dd>
                        <dt>Жилая, м²</dt><dd>59</dd>
                        <dt>Ремонт</dt><dd>Косметический</dd>
                        <dt>Этаж в доме</dt><dd>4</dd>
                        <dt>Вид из окна</dt><dd>На двор</dd>
                        <dt>Этажей в доме</dt><dd>11</dd>
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
                    <div class="row row-cols-1 row-cols-lg-3">
                        <div class="col">
                            Коммунальные услуги
                            <div class="item__addictional-info">1500 ₽</div>
                            *Включает оплату за газ, свет и холодную воду
                        </div>
                        <div class="col">
                            Право собственности
                            <div class="item__addictional-info">Собственик</div>
                        </div>
                        <div class="col">
                            Статус проверки
                            <span class="float-end"><img src="/images/icons/info-circle-gray.svg"></span>
                            <div class="item__addictional-info text-primary">Пройдено</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-warning btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>




<script src="/js/app.min.js"></script>

</body>
</html>
<?php
/**
 * @var array $objects
 * @var array $reviews
 **/

$_page_title = "Главная страница | Take Keys";
?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<div class="home-header ratio-em ratio-em-21x9" style="background-image: url('/images/dist/home.jpg');">
    <div class="home-header-content py-5">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-12">
                    <h1 class="h1 mb-4">Найдите дом своей мечты</h1>
                    <div class="home-header__desc mx-auto">Take Keys объединяет объявления о недвижимости самых популярных площадок Рунета, чтобы сделать подбор жилья максимально удобным для Вас</div>
                </div>
                <div class="col-12 col-lg">
                    <div class="home-header__item">
                        <i class="icon"><img src="/images/icons/shield-dark.svg"></i>
                        <div class="home-header__item__text">
                            Без переплат риелторам
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="home-header__item">
                        <i class="icon"><img src="/images/icons/shield-dark.svg"></i>
                        <div class="home-header__item__text">
                            Только собственники
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="home-header__item">
                        <i class="icon"><img src="/images/icons/shield-dark.svg"></i>
                        <div class="home-header__item__text">
                            Проверка объектов через ЕГРН в 1 click
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="h1 mt-5">Каталог недвижимости</h1>
    <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mt-3 justify-content-center">
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/1.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Длительная аренда</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Студии</a></li>
                        <li><a class="link-dark" href="/catalog/">1-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">2-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">3-комнатные квартиры</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/2.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Посуточная аренда</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">Дома, дачи, коттеджи</a></li>
                        <li><a class="link-dark" href="/catalog/">Комнаты</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/3.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Купить квартиру</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Студии</a></li>
                        <li><a class="link-dark" href="/catalog/">1-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">2-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">Еще <img class="ms-2" src="/images/icons/arrow-right-dark.svg" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/4.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Вторичное жилье</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Сталинка</a></li>
                        <li><a class="link-dark" href="/catalog/">Ленинка квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">Панельный дома</a></li>
                        <li><a class="link-dark" href="/catalog/">Еще <img class="ms-2" src="/images/icons/arrow-right-dark.svg" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/5.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Новострой</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Студии</a></li>
                        <li><a class="link-dark" href="/catalog/">1-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">2-комнатные квартиры</a></li>
                        <li><a class="link-dark" href="/catalog/">Еще <img class="ms-2" src="/images/icons/arrow-right-dark.svg" alt=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/6.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Гаражи и машиноместа</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Купить гараж</a></li>
                        <li><a class="link-dark" href="/catalog/">Купить машиноместо</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять гараж</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять машиноместо</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/7.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Коммерческая</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Снять офис</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять ПСН</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять торговую площадь</a></li>
                        <li><a class="link-dark" href="/catalog/">Купить</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/8.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Земеные участки</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Земпя промназначения</a></li>
                        <li><a class="link-dark" href="/catalog/">Земля сельхозназначения</a></li>
                        <li><a class="link-dark" href="/catalog/">Купить землю для поселения</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять участок</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <div class="col">
            <div class="catalog__item">
                <div class="ratio ratio-16x9">
                    <div class="catalog__item__img" style="background-image: url('/images/dist/home-catalog/9.png');"></div>
                </div>
                <div class="catalog__item__info">
                    <div class="catalog__item__title">Дома, дачи, коттеджи</div>

                    <ul class="catalog__item__list list-unstyled">
                        <li><a class="link-dark" href="/catalog/">Купить</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять на длительный срок</a></li>
                        <li><a class="link-dark" href="/catalog/">Снять посуточно</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </div>
</div>

<section class="map-overlay mt-5 ratio-em" style="background-image: url('/images/dist/map-overlay.jpg')">
    <div class="container position-relative">
        <div class="h1 mb-3">Поиск на карте</div>
        <div class="mb-4">Ищите предложения рядом с работой, парком или родственниками</div>
        <a href="/catalog/map" class="btn btn-outline-dark fw-500 px-4">Смотреть карту</a>
    </div>
</section>
<div class="container mt-5">
    <?php if(!is_null($objects)) { ?>
    <div class="h1 item__desc-title d-block mt-3 mt-lg-5">Рекомендуемое для Вас</div>
    <div class="catalog pb-4">
        <div class="row g-3">
            <?php
                $showed = 0;
                foreach($objects as $object) {
                    if(empty($object->images)) continue;
                    echo view("objects.item", [
                        'object' => $object,
                        'images' => $object->images,
                        'col_class' => "col-12 col-lg-4"
                    ]);
                    $showed++;
                    if($showed == 3) break;
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-auto ms-lg-auto order-lg-2">
            <a href="/catalog" class="btn btn-icon">
                <div class="d-flex align-items-center">
                    Перейти в каталог<i class="icon ms-auto"><img src="/images/icons/arrow-big-right.svg"></i>
                </div>
            </a>
        </div>
    </div>
    <?php } ?>


    <div class="h1 item__desc-title d-block mt-3 mt-lg-5">Используйте больше инструментов для поиска жилья</div>
    <div class="home-steps py-4">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 gy-3 justify-content-center">
            <div class="col">
                <div class="setting-item">
                    <div class="setting-item__icon">
                        <button class="btn btn-primary btn-icon btn-aura">
                            <i class="icon">1</i>
                        </button>
                    </div>
                    <div class="setting-item__title mt-4">
                        Экономьте время на поиске жилья
                    </div>
                    <div class="setting-item__desc mt-3">
                        Подключите услугу авто подбор подходящих вариантов и система автоматически выберет самые лучшие варианты по
                        цене, местоположению, условиям и дате заезда.
                    </div>
                    <div class="setting-item__btn mt-auto">
                        <a href="#" class="btn btn-outline-dark rounded-pill px-4 mt-3">Подробнее</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="setting-item">
                    <div class="setting-item__icon">
                        <button class="btn btn-primary btn-icon btn-aura">
                            <i class="icon">2</i>
                        </button>
                    </div>
                    <div class="setting-item__title mt-4">
                        Узнавайте первыми о новых объявлениях
                    </div>
                    <div class="setting-item__desc mt-3">
                        Звоните собственникам уже через секунду после появления объекта. Мы уведомим на почту и в месседжер.
                    </div>
                    <div class="setting-item__btn mt-auto">
                        <a href="#" class="btn btn-outline-dark rounded-pill px-4 mt-3">Подробнее</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="setting-item">
                    <div class="setting-item__icon">
                        <button class="btn btn-primary btn-icon btn-aura">
                            <i class="icon">3</i>
                        </button>
                    </div>
                    <div class="setting-item__title mt-4">
                        Экономьте время на поиске жилья
                    </div>
                    <div class="setting-item__desc mt-3">
                        Подключите услугу авто подбор подходящих вариантов и система автоматически выберет самые лучшие варианты по
                        цене, местоположению, условиям и дате заезда.
                    </div>
                    <div class="setting-item__btn mt-auto">
                        <a href="#" class="btn btn-outline-dark rounded-pill px-4 mt-3">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<section class="reviews py-5">
    <div class="container">
        <div class="h1 text-center mb-4">Отзывы наших клиентов</div>
        <!-- Slider main container -->

        <div class="row-scroll-x">
            <div class="reviews__bullets mb-4 row gx-3 flex-nowrap">
                <!--#set var="col-class" value="col-9 col-lg-5" -->
                <!--#include virtual="/parts/catalog-item.html" -->
                <!--#include virtual="/parts/catalog-item.html" -->
                <!--#include virtual="/parts/catalog-item.html" -->
                <!--#include virtual="/parts/catalog-item.html" -->
                <!--#include virtual="/parts/catalog-item.html" -->
            </div>
        </div>
        <!-- If we need pagination -->
        <div class=""></div>
        <div class="swiper reviews__swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                    foreach($reviews as $review) {
                        echo view("layout.index_review", [
                            'review' => $review
                        ]);
                    }
                ?>
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>
</section>

<section class="support-center mt-4 p-3" style="background-image: url('/images/dist/support-center.svg');">
    <div class="support-center__inner">
        <div class="h1 mb-3">Справочный центр</div>
        <div class="mb-4">Подробные инструкции по функциям, ответы на часто задаваемые вопросы, ознакомительный тур и
            полезные ссылки</div>
        <a href="//take-keys.com/help" class="btn btn-white rounded-pill px-4">Смотреть</a>
    </div>
</section>

<button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer")?>

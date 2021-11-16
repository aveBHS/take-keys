<?php
/**
 * @var object $object
 * @var array $images
 * @var string VIEW_PATH
 * @var bool $purchased
 **/
global $auth;
global $request;
$page_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$page_url = explode('?', $page_url);
$page_url = $page_url[0];

if(count($images) == 0) {
    $images = [new stdClass()];
    $images[0]->path = "//" . env('url') . "/uploads/default.jpg";
}

$is_favorite = false;
if(!is_null($auth())){
    if(in_array("{$object->id}", explode(",", $auth()->request->favorites))){
        $is_favorite = true;
    }
}
?>

<?=view("layout.header", ["_page_title" => $object->title])?>
<style>
    .ya-share2__icon{
        background-image: url("/images/icons/share.svg") !important;
        height: 3em !important;
        width: 3em !important;
        line-height: 1 !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
    .ya-share2__link, .ya-share2__link_more, .ya-share2__link_more-button-type_short{
        height: 3em !important;
        width: 3em !important;
        line-height: 1 !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
    }
</style>
<div class="d-none d-lg-block">
    <?=view("layout.breadcrumb", ["url" => ["Каталог", [$object->title, $page_url]]])?>
</div>
<div class="item">
    <div class="item__top-menu-mobile">
        <i class="icon"><img src="/images/icons/arrow-left-dark.svg"></i>
        <button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat-top ms-3">
            <i class="icon"><img src="/images/icons/chat-16.svg"></i>
        </button>
        <i class="icon ms-auto"><img src="/images/icons/search.svg"></i>
        <i class="icon"><img src="/images/icons/share.svg"></i>
        <span onclick="setFavorite(this)" data-object-id="<?=$object->id?>">
        <?php if($is_favorite) { ?>
            <i class="icon"><img src="/images/icons/heart_checked.svg"></i>
        <?php } else { ?>
            <i class="icon"><img src="/images/icons/heart.svg"></i>
        <?php } ?>
        </span>
    </div>
    <div class="container">
        <div class="row position-relative">
            <div class="col-lg-8 col-xxl-9 pb-lg-5 order-lg-3">
                <?=view("layout.item_slider", ["images" => $images, "object" => $object])?>
            </div>

            <div class="col-lg-8 col-xxl-9 order-lg-1">
                <h1 class="h1 item__title my-2 my-lg-0"><?=$object->title?></h1>
                <div class="d-none d-lg-block">
                    <div class="row gx-0 align-items-center">
                        <div class="col-auto">
                            <span class="item__date me-3">Опубликовано: <?=cuteDate($object->created)?></span>
                        </div>
                        <div class="col-auto">
                            <span class="icon"><img src="/images/icons/eye.svg"></span>
                        </div>
                        <div class="col-auto">
                            <span class="views-counter"><?=rand(100, 999)?> просмотров</span>
                        </div>
                        <div class="col-auto ms-auto">
                            <i class="icon"><img src="/images/icons/share.svg"></i>
                        </div>
                        <div class="col-auto ms-2">
                            <button class="btn btn-outline-light btn-icon" onclick="setFavorite(this)" data-object-id="<?=$object->id?>">
                                <?php if($is_favorite) { ?>
                                    <i class="icon"><img src="/images/icons/heart_checked.svg"></i>
                                <?php } else { ?>
                                    <i class="icon"><img src="/images/icons/heart.svg"></i>
                                <?php } ?>
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
                            <i class="icon ms-auto"><img src="/images/icons/check.svg"></i>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="ps-3">
                                <div class="fw-semibold">Продажа</div>
                                <div class="fw-normal text-nowrap"><span style="color:silver">Не указано</span></div>
                            </div>
                            <i class="icon ms-auto"><img src="/images/icons/check.svg"></i>
                        </div>
                        <div class="px-3 fs-14 fw-normal mb-2">
                            *Информация указана на основание рыночной статистике. Окончательное решение о стоимости и типе сделки, а также удобства определяет собственник.
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xxl-3 order-lg-4 item__contact-wrp">
                <div class="item__contact">
                    <div id="action_block">
                        <?php if($object->status > 1) { ?>
                            <form>
                                <button type="button" onclick="object_archived();" class="btn btn-48 btn-secondary w-100 mb-3">Связаться</button>
                                <button type="button" onclick="object_archived();" class="btn btn-48 btn-secondary w-100 mb-4">Бронировать</button>
                            </form>
                        <?php } else if($purchased) { ?>
                            <button type="button" class="btn btn-48 btn-primary w-100 mb-3" onclick="send_call_request();">Связаться</button>
                            <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark w-100 mb-4">Бронировать</button></a>
                        <?php } else if(!is_null($auth())) { ?>
                            <button class="btn btn-48 btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#popup-tarif-take-keys">Связаться</button>
                            <button class="btn btn-48 btn-dark w-100 mb-4" data-bs-toggle="modal" data-bs-target="#popup-tarif-take-keys" >Бронировать</button>
                        <?php } else { ?>
                            <button class="btn btn-48 btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#popup-auth">Связаться</button>
                            <button class="btn btn-48 btn-dark w-100 mb-4" data-bs-toggle="modal" data-bs-target="#popup-auth">Бронировать</button>
                        <?php } ?>
                    </div>
                    <div class="item__owner"> <!-- 'active' class для онлайна-->
                        <div class="item__owner__avatar">
                            <img src="/images/dist/ava.png" alt="Чат с владельцем" style="width: 50px;">
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
                            <div class="col-lg-auto ms-auto">
                                <div class="w-mobile-100">
                                    <button class="btn btn-icon w-100 collapsed" data-bs-toggle="collapse" data-bs-target=".map-collapse">
                                        <div class="d-flex align-items-center">
                                            Показать на карте<i class="icon icon-arrow-up ms-auto"><img src="/images/icons/arrow-up.svg"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse map-collapse w-mobile-100">
                    <div class="item__map mt-lg-4 pb-lg-5" style="background-image: url('/images/dist/map.jpg');"></div>
                </div>

                <div class="desc">
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
                                <div class="item__addictional-info text-primary">Все включено</div>
                                <div class="fs-12">*Окончательную стоимость уточняйте у владельца</div>
                            </div>
                            <div class="col">
                                Право собственности
                                <div class="item__addictional-info">Собственик</div>
                            </div>
                            <div class="col position-relative">
                                Статус проверки
                                <span class="item__check-status-open"></span>
<!--                                <div class="item__check-status">-->
<!---->
<!--                                    <div class="fw-semibold">Результат:</div>-->
<!--                                    <div>По базам агентов:</div>-->
<!--                                    <div class="text-primary mb-2">Пройдено</div>-->
<!---->
<!--                                    <div>По чёрному списку номеров:</div>-->
<!--                                    <div class="text-warning mb-2">Ожидает проверки</div>-->
<!---->
<!--                                    <div>Алгоритмом предупреждения сомнительных объявлений:</div>-->
<!--                                    <div class="text-danger mb-2">Не пройдено</div>-->
<!---->
<!--                                    <div>Проверка через ЕГРН:</div>-->
<!--                                    <div class="text-warning">Ожидает проверки</div>-->
<!---->
<!--                                </div>-->
                                <?php if($object->isAd == 1 or $object->status == 1){ ?>
                                    <div class="item__addictional-info text-warning">На проверке</div>
                                <?php } else if($object->status == 2){ ?>
                                    <div class="item__addictional-info text-danger">Архив</div>
                                <?php } else { ?>
                                    <div class="item__addictional-info text-primary">Пройдено</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__owner active mt-3 d-lg-none"> <!-- 'active' class для онлайна-->
                    <div class="item__owner__avatar">
                        <img src="/images/dist/ava.png" alt="Чат с владельцем" style="width: 50px;">
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

                <?php if(!is_null($auth())) { ?>
                    <div class="h1 item__desc-title d-block mt-3 mt-lg-0 mb-0">Вас может заитересовать</div>
                    <div class="h-48">
                        <div class="text-secondary fw-normal fs-14">Изменить параметры поиска</div>
                    </div>
                    <div class="catalog pb-4 pb-lg-5 row-scroll-x">
                        <div class="row gx-2 flex-nowrap">
                            <div class="row gx-2 flex-nowrap" id="recommendations-list"></div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-auto ms-lg-auto order-lg-2">
                            <a href="/catalog/recommendations" class="btn btn-icon">
                                <div class="d-flex align-items-center">
                                    Все рекомендации<i class="icon ms-auto"><img src="/images/icons/arrow-big-right.svg"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-auto order-lg-1">
                            <!--#include virtual="/parts/pagination.html" -->
                        </div>
                    </div>
                <?php } ?>


                <div class="h1 item__desc-title d-block mt-3 mt-lg-5">Недавно просмотренные</div>
                <div class="catalog row-scroll-x">
                    <div class="row gx-2 flex-nowrap" id="recent-viewed"></div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="item__fixed-buttons p-3" id="mobile_action_block">
    <?php if($object->status > 1) { ?>
        <button type="button" onclick="object_archived();" class="btn btn-48 btn-secondary">Связаться</button>
        <button type="button" onclick="object_archived();" class="btn btn-48 btn-secondary">Бронировать</button>
    <?php } else if($purchased) { ?>
        <button type="button" class="btn btn-48 btn-primary" onclick="send_call_request();">Связаться</button>
        <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark">Бронировать</button></a>
    <?php } else if(!is_null($auth())) { ?>
        <button class="btn btn-48 btn-primary" data-bs-toggle="modal" data-bs-target="#popup-tarif-take-keys">Связаться</button>
        <button class="btn btn-48 btn-dark" data-bs-toggle="modal" data-bs-target="#popup-tarif-take-keys" >Бронировать</button>
    <?php } else { ?>
        <button class="btn btn-48 btn-primary" data-bs-toggle="modal" data-bs-target="#popup-auth">Связаться</button>
        <button class="btn btn-48 btn-dark" data-bs-toggle="modal" data-bs-target="#popup-auth">Бронировать</button>
    <?php } ?>
</div>
<button onclick="Chatra('openChat', true)" class="btn btn-warning btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>
<br><br>

<script>
    let object_id = <?=$object->id?>;
    let user_id = <?=is_null($auth()) ? -1 : $auth()->id?>;
</script>

<?php
if(is_null($auth())) {
    echo(view("layout.popup.auth", ['forceReg' => true]));
}
if(!$purchased || is_null($auth())){
    echo(view("layout.popup.purchase", [
        'name'     => $auth()->name,
        'continue' => $request->getFlash("action") == "continue" && !$purchased
    ]));
    echo(view("layout.payment_widget", ["amount" => 99]));
    echo(view("layout.popup.payment_result"));
}
echo(view("layout.popup.autocall"));
?>
<script src="https://yastatic.net/share2/share.js"></script>
<?=view("layout.footer", ['render' => false])?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        function dynamicContent() {
            lazyAjaxCatalog('#recent-viewed', '//<?=env("url")?>/api/objects/recent/', {})
            lazyAjaxCatalog('#recommendations-list', '//<?=env("url")?>/api/objects/recommendations/', {})
        }
        dynamicContent()

        $(window).scroll(function () {
            dynamicContent()
        })
    })
</script>

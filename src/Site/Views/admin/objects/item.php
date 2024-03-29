<?php
/**
 * @var string $col_class
 * @var array $images
 * @var object $object
 * @var string $mode
 * @var bool $is_sell
 */

global $auth;
if(count($images) == 0){
    $images = [new stdClass()];
    $images[0]->path = "//".env('url')."/uploads/default.jpg";
}

if(is_null($mode)) $mode = "tiles";

$is_favorite = false;
if(!is_null($auth())){
    if(in_array("{$object->id}", explode(",", $auth()->request->favorites))){
        $is_favorite = true;
    }
}

?>
<?php if($mode != "lines") { ?>
    <div class="<?=$col_class ?? 'col'?>">
        <div class="catalog__item">
            <div class="catalog__item-slider lazy">
                <div class="catalog__item-slider">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <!-- Slides -->
                        <?php foreach($images as $image) { ?>
                            <div class="swiper-slide catalog__item-slider__slide">
                                <div class="catalog__item-slider__blur-bg swiper-lazy" data-background="<?=$image?>">
                                </div>
                                <div class="catalog__item-slider__bg ratio swiper-lazy" data-background="<?=$image?>">
                                </div>
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="swiper-pagination-counter d-none mb-2">
                        <span class="current">1</span>/
                        <span class="total"><?=count($images)?></span>
                    </div>

                    <div class="swiper-pagination"></div>

                    <div class="swiper-alt-clock">
                        <img class="me-2" src="/images/icons/clock.svg">
                        <span><?=cuteDate($object->created)?></span>
                    </div>

                    <div class="swiper-alt-photo">
                        <img class="me-2" src="/images/icons/photo-white.svg">
                        <span class="total"><?=count($images)?></span>
                    </div>
                </div>
            </div>
            <div class="catalog__item__info">
                <a href="/panel/objects/catalog_sell/id/<?=$object->id?>" class="catalog__item__title">
                    <?=$object->title?>
                </a>
                <div class="catalog__item__price">
                    <span class="catalog__item__price-new"><?=$object->cost?> ₽<?=$is_sell?"":"/мес."?></span>
                    <s class="catalog__item__price-old"><?=$object->cost*1.1?> ₽</s>
                </div>
                <div class="catalog__item__address"><?=$object->address?></div>
                <?php if(!empty($object->metroSlug)) { ?>
                <div class="catalog__item__metro row">
                    <div class="col-12 order-lg-2">
                        <div class="row g-0">
                            <?php foreach(explode("|", $object->metroSlug) as $metro){ ?>
                                <div class="col-auto item__metro">
                                    <img class="me-2" src="/images/icons/metro.svg"><?=$metro?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="catalog__item__param d-none d-lg-flex">
                    <i class="icon"><img src="/images/icons/home.svg"></i>1
                    <i class="ms-4 icon"><img src="/images/icons/box.svg"></i><?=$object->sq?> м²
                </div>
                <div class="row gx-0 justify-content-between mt-auto">
                    <div class="col-auto order-lg-2 ms-lg-auto">
                        <button class="btn btn-outline-light btn-icon">
                            <i class="icon"><img src="/images/icons/share.svg"></i>
                        </button>
                    </div>
                    <div class="col-auto order-lg-2">
                        <button class="btn btn-outline-light btn-icon" onclick="setFavorite(this)" data-object-id="<?=$object->id?>">
                            <?php if($is_favorite) { ?>
                                <i class="icon"><img src="/images/icons/heart_checked.svg"></i>
                            <?php } else { ?>
                                <i class="icon"><img src="/images/icons/heart.svg"></i>
                            <?php } ?>
                        </button>
                    </div>
                    <div class="col-auto order-lg-2 d-lg-none">
                        <button class="btn btn-outline-light btn-icon">
                            <i class="icon"><img src="/images/icons/plus.svg"></i>
                        </button>
                    </div>
                    <div class="col-12 col-lg-auto order-lg-1">
                        <a href="/panel/objects/catalog_sell/id/<?=$object->id?>">
                            <button class="btn btn-primary catalog__item__btn-show">Смотреть</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="<?=$col_class ?? 'col'?>">
        <div class="catalog__item">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <a href="/panel/objects/catalog_sell/id/<?=$object->id?>" class="catalog__item-slider h-100">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach($images as $image) { ?>
                                <div class="swiper-slide catalog__item-slider__slide">
                                    <div class="catalog__item-slider__blur-bg swiper-lazy" data-background="<?=$image?>">
                                    </div>
                                    <div class="catalog__item-slider__bg ratio swiper-lazy" data-background="<?=$image?>">
                                    </div>
                                    <div class="swiper-lazy-preloader"></div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="swiper-pagination-counter d-none mb-2">
                            <span class="current">1</span>/
                            <span class="total"><?=count($images)?></span>
                        </div>

                        <div class="swiper-pagination"></div>

                        <div class="swiper-alt-clock">
                            <img class="me-2" src="/images/icons/clock.svg">
                            <span><?=cuteDate($object->created)?></span>
                        </div>

                        <div class="swiper-alt-photo">
                            <img class="me-2" src="/images/icons/photo-white.svg">
                            <span class="total"></span>
                        </div>

                        <div class="item__tags">
                            <!--span class="btn-colored bg-danger">Лучшая цена</span-->
                            <?php if(isNew($object->created)) { ?>
                                <span class="btn-colored bg-primary">Проверено в ЕРГН</span>
                            <?php } ?>
                            <?php if(!is_null($auth()) && strpos($auth()->request->recommendations, "{$object->id}") !== false) { ?>
                                <span class="btn-colored bg-info">Рекомендуемые</span>
                            <?php } ?>
                            <?php if($object->isAd || $object->isAd == 1) { ?>
                                <span class="btn-colored bg-danger text-light">A</span>
                            <?php } ?>
                            <?php if($object->status == 1 || $object->isAd == 1) { ?>
                                <!--span class="btn-colored bg-warning">На проверке</span-->
                            <?php } ?>
                            <?php if($object->status == 2) { ?>
                                <span class="btn-colored bg-secondary">В архиве</span>
                            <?php } ?>
                        </div>

                    </a>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="catalog__item__info h-100">
                        <a class="catalog__item__title" href="/panel/objects/catalog_sell/id/<?=$object->id?>">
                            <?=$object->title?>
                        </a>
                        <div class="catalog__item__price">
                            <span class="catalog__item__price-new"><?=$object->cost?> ₽<?=$is_sell?"":"/мес."?></span>
                            <s class="catalog__item__price-old"><?=$object->cost*1.1?> ₽</s>
                        </div>
                        <div class="catalog__item__address"><?=$object->address?></div>
                        <?php if(!empty($object->metroSlug)) { ?>
                            <div class="catalog__item__metro row">
                                <div class="col-12 order-lg-2">
                                    <div class="row g-0">
                                        <?php foreach(explode("|", $object->metroSlug) as $metro){ ?>
                                            <div class="col-auto item__metro">
                                                <img class="me-2" src="/images/icons/metro.svg"><?=$metro?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="catalog__item__desc">
                            <?=mb_strlen($object->description) > 250 ?
                                mb_substr($object->description, 0, 250) . "..." :
                                $object->description?>
                        </div>
                        <div class="row gx-0 justify-content-between mt-auto">
                            <div class="col-auto">
                                <a href="/panel/objects/catalog_sell/id/<?=$object->id?>">
                                    <button class="btn btn-primary catalog__item__btn-show">Смотреть</button>
                                </a>
                            </div>
                            <div class="col-auto ms-auto">
                                <div class="catalog__item__param d-none d-lg-flex">
                                    <i class="icon"><img src="/images/icons/home.svg"></i>1
                                    <i class="ms-4 icon"><img src="/images/icons/box.svg"></i><?=$object->sq?> м²
                                </div>
                            </div>
                            <div class="col-auto ms-auto">
                                <button class="btn btn-outline-light btn-icon">
                                    <i class="icon"><img src="/images/icons/share.svg"></i>
                                </button>
                            </div>
                            <div class="col-auto">
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
            </div>
        </div>
    </div>
<?php } ?>
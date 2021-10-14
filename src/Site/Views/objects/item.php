<?php
/**
 * @var string $col_class
 * @var array $images
 * @var object $object
 * @var string $mode
 */

if(is_null($mode)) $mode = "tile";

?>
<?php if($mode != "lines") { ?>
    <div class="<?=$col_class ?? 'col'?>">
        <div class="catalog__item">
            <div class="catalog__item-slider">

                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">

                    <!-- Slides -->
                    <?php foreach($images as $image) { $image->path = "/images/dist/item-slide-1.jpg"; ?>
                    <div class="swiper-slide catalog__item-slider__slide">
                        <div class="catalog__item-slider__blur-bg" style="background-image: url('<?=$image->path?>');">
                        </div>
                        <div class="catalog__item-slider__bg ratio" style="background-image: url('<?=$image->path?>');">
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="swiper-pagination-counter d-lg-none mb-2">
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

                <div class="item__tags">
                    <span class="btn-colored bg-danger">Лучшая цена</span>
                    <span class="btn-colored bg-primary">Новое</span>
                </div>

            </div>
            <div class="catalog__item__info">
                <div class="catalog__item__title">
                    <?=$object->title?>
                </div>
                <div class="catalog__item__price">
                    <span class="catalog__item__price-new"><?=$object->cost?> ₽/мес.</span>
                    <s class="catalog__item__price-old"><?=$object->cost*1.25?> ₽</s>
                </div>
                <div class="catalog__item__address"><?=$object->address?></div>
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
                        <a href="/id/<?=$object->id?>">
                            <button class="btn btn-outline-dark catalog__item__btn-show">Смотреть</button>
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
                <div class="col-5">
                    <div class="catalog__item-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach($images as $image) { $image->path = "/images/dist/item-slide-1.jpg"; ?>
                                <div class="swiper-slide catalog__item-slider__slide">
                                    <div class="catalog__item-slider__blur-bg" style="background-image: url('<?=$image->path?>');">
                                    </div>
                                    <div class="catalog__item-slider__bg ratio" style="background-image: url('<?=$image->path?>');">
                                    </div>
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
                            <span class="btn-colored bg-danger">Лучшая цена</span>
                            <span class="btn-colored bg-primary">Новое</span>
                        </div>

                    </div>
                </div>
                <div class="col-7">
                    <div class="catalog__item__info h-100">
                        <div class="catalog__item__title">
                            <?=$object->title?>
                        </div>
                        <div class="catalog__item__price">
                            <span class="catalog__item__price-new"><?=$object->cost?> ₽/мес.</span>
                            <s class="catalog__item__price-old"><?=$object->cost*1.25?> ₽</s>
                        </div>
                        <div class="catalog__item__address"><?=$object->address?></div>
                        <div class="catalog__item__desc">
                            <?=substr($object->description, 0, 250)?>...
                        </div>
                        <div class="row gx-0 justify-content-between mt-auto">
                            <div class="col-auto">
                                <a href="/id/<?=$object->id?>">
                                    <button class="btn btn-outline-dark catalog__item__btn-show">Смотреть</button>
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
                                <button class="btn btn-outline-light btn-icon">
                                    <i class="icon"><img src="/images/icons/heart.svg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
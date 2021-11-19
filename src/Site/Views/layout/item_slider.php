<?php
/**
 * @var object $object
 * @var array $images
 */

global $auth;

?>

<!-- Slider main container -->
<div class="item-slider w-mobile-100 mt-2 mt-lg-4" data-swiper-speed="700">

    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">

        <!-- Slides -->
        <?php
        foreach($images as $image){ ?>
            <div class="swiper-slide item-slider__slide" data-swiper-autoplay="20000">
                <div class="item-slider__blur-bg" style="background-image: url('<?=$image->path?>');" data-swiper-parallax="40%"></div>
                <div class="item-slider__bg ratio" data-swiper-parallax="40%"
                     style="background-image: url('<?=$image->path?>');" data-thumb="<?=$image->path?>"></div>
            </div>
        <?php }
        ?>
    </div>

    <div class="swiper-pagination-counter mb-2 d-lg-none">
        <span class="current">1</span>/
        <span class="total"><?=count($images)?></span>
    </div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"><i class="icon"><img src="/images/icons/arrow-left.svg"></i></div>
    <div class="swiper-button-next"><i class="icon"><img src="/images/icons/arrow-right.svg"></i></div>

    <div class="item__tags">
        <!--span class="btn-colored bg-danger">Лучшая цена</span-->
        <?php if(isNew($object->created)) { ?>
            <span class="btn-colored bg-primary">Новое</span>
        <?php } ?>
        <!--span class="btn-colored bg-warning">Горячее</span-->
        <?php if(!is_null($auth()) && strpos($auth()->request->recommendations, "{$object->id}") !== false) { ?>
            <span class="btn-colored bg-info">Рекомендуемые</span>
        <?php } ?>
        <?php if($object->isAd || $object->isAd == 1) { ?>
            <span class="btn-colored bg-danger text-light">Горячее</span>
        <?php } ?>
        <?php if($object->status == 1 || $object->isAd == 1) { ?>
            <!--span class="btn-colored bg-warning">На проверке</span-->
        <?php } ?>
        <?php if($object->status == 2) { ?>
            <span class="btn-colored bg-secondary">В архиве</span>
        <?php } ?>
    </div>

</div>

<div class="slider__gallery clearfix">

	<span class="slider__gallery__thumb icon-photo">
		<img class="me-2" src="/images/icons/photo.svg"><span class="total"><?=count($images)?></span>
	</span>
    <span class="swiper-pagination-custom"></span>
</div>
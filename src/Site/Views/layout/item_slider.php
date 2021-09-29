<?php
/**
 * @var array $images
 */
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
        <span class="btn-colored bg-danger">Лучшая цена</span>
        <span class="btn-colored bg-primary">Новое</span>
        <span class="btn-colored bg-warning">Горячее</span>
        <span class="btn-colored bg-info">Рекомендуемые</span>
        <?php if(isset($checking)) { ?>
            <span class="btn-colored bg-white text-dark">На проверке</span>
        <?php } ?>
    </div>

</div>

<div class="slider__gallery clearfix">

	<span class="slider__gallery__thumb icon-photo">
		<img class="me-2" src="/images/icons/photo.svg"><span class="total"><?=count($images)?></span>
	</span>
    <span class="swiper-pagination-custom"></span>
</div>
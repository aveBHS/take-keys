<?php
/**
 * @var array $review
 */
?>
<div class="swiper-slide">
    <div class="reviews__slide">
        <div class="col-auto reviews__author"><div class="reviews__author-img" style="background-image: url('/images/dist/reviews/<?=$review->ava?>');"></div></div>
        <div class="fs-4"><?=$review->name?></div>
        <div class=""><?=htmlspecialchars($review->text)?></div>
    </div>
</div>
<?php
/**
 * @var int $elements_count
 * @var int $current_page
 * @var int $elements_per_page
 * @var string $origin_url
 */

$max_pages = 5;
$pages_count = ceil($elements_count / $elements_per_page);
if($pages_count < 2) return;

$next_page = $current_page+2 > $pages_count ? $pages_count : $current_page+2;
$previous_page = $current_page-2 < 1 ? 1 : $current_page-2;

$current_page++;
if($current_page >= $max_pages){
    if($current_page + floor($max_pages / 2) > $pages_count){
        $page_range = range($pages_count - $max_pages + 1, $pages_count);
    } else {
        $page_range = range($current_page - floor($max_pages / 2), $current_page + floor($max_pages / 2));
    }
} else {
    if($max_pages > $pages_count){
        $page_range = range(1, $pages_count);
    } else {
        $page_range = range(1, $max_pages);
    }
}
?>

<div class="pagination">
    <?php if ($current_page != 1) { ?>
    <a href="<?=$origin_url?>/1" class="btn pagination__item"><img src="/images/icons/arrow-left-dark.svg"></a>
    <?php } ?>
    <?php foreach($page_range as $page_id){ ?>
        <a href="<?=$origin_url?>/<?=$page_id?>" class="btn pagination__item <?=$page_id == ($current_page) ? "active": ""?>"><?=$page_id?></a>
    <?php } ?>
    <?php if ($current_page != $pages_count) { ?>
        <a href="<?=$origin_url?>/<?=$pages_count?>" class="btn pagination__item"><img src="/images/icons/arrow-right-dark.svg"></a>
    <?php } ?>
</div>

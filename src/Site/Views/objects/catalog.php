<?php
/**
 * @var array $objects
 * @var array $images
 * @var bool $purchased
 * @var string $title
 *
 * @var int $objects_count
 * @var int $current_page
 * @var int $elements_per_page
 * @var string $origin_url
 **/

global $auth;
global $request;
?>

<?=view("layout.header", ["_page_title" => $title])?>

<div class="container">
    <h1 class="h1 item__title my-2 my-lg-0"><?=$title?></h1>
    <div class="h-48 fs-18"><?=$objects_count?> вариантов</div>

    <div class="row gx-3 gy-2 align-items-center mb-3">
        <div class="col-auto">
            <button class="btn btn-icon">
                <img class="me-2" src="/images/icons/swap.svg">
                Рекомендуемые
                <img src="/images/icons/arrow-down.svg">
            </button>
        </div>
        <div class="col-auto">
            <button class="btn btn-icon">Показать на карте</button>
        </div>
        <div class="w-100 d-sm-none"></div>
        <div class="col-auto">
            <button onclick="setCatalogView('lines')" class="btn btn-icon"><span class="catalog__view-list"></span></button>
        </div>
        <div class="col-auto">
            <button onclick="setCatalogView('tiles')" class="btn btn-icon"><span class="catalog__view-card"></span></button>
        </div>
    </div>
        <?php if($request->getCookie("catalog_view_mode") == "lines") { ?>
            <div class="row g-4 row-cols-1 mb-4">
        <?php } else { ?>
            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
        <?php } ?>
            <?php
            foreach ($objects as $object) {
                echo view("objects.item", [
                    'object' => $object,
                    'images' => $object->images,
                    'col_class' => "col",
                    'mode' => $request->getCookie("catalog_view_mode") ?? 'tiles'
                ]);
            }
            ?>
        </div>

    <div class="mt-4">
        <?=view("layout.pagination", [
            "elements_count"    => $objects_count,
            "current_page"      => $current_page,
            "elements_per_page" => $elements_per_page,
            "origin_url"        => $origin_url
        ])?>
    </div>
</div>



<button class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer")?>

<script src="/js/catalog.js"></script>
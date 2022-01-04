<?php
/**
 * @var array $objects
 * @var array $objects_types
 * @var array $images
 * @var bool $purchased
 * @var string $title
 *
 * @var int $objects_count
 * @var int $current_page
 * @var int $elements_per_page
 * @var string $origin_url
 *
 * @var int $filter_type
 * @var bool $is_sell
 **/

global $auth;
global $request;
?>

<?=view("layout.header", ["_page_title" => $title, "_custom_button" => ["apanel", "Админ панель"]])?>

<div class="container">
    <h1 class="h1 item__title mb-2 mt-5"><?=$title?></h1>

    <?=view("admin.objects.search", ["objects_types" => $objects_types])?>

    <div class="h-48 fs-18"><?=(count($objects) > 0) ? $objects_count : "Нет"?> вариантов</div>

    <div class="row gx-3 gy-2 align-items-center mb-3">
        <div class="w-100 d-sm-none"></div>
        <div class="col-auto">
            <button onclick="setCatalogView('lines')" class="btn btn-icon"><span class="catalog__view-list"></span></button>
        </div>
        <div class="col-auto">
            <button onclick="setCatalogView('tiles')" class="btn btn-icon"><span class="catalog__view-card"></span></button>
        </div>
    </div>
        <?php if(count($objects) > 0) { ?>
            <?php if($request->getCookie("catalog_view_mode") == "lines") { ?>
                <div class="row g-4 row-cols-1 mb-4">
            <?php } else { ?>
                <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php } ?>
                <?php
                foreach ($objects as $object) {
                    echo view("admin.objects.item", [
                        'object' => $object,
                        'images' => explode("|", $object->images),
                        'col_class' => "col",
                        'mode' => $request->getCookie("catalog_view_mode") ?? 'tiles',
                        'is_sell' => $is_sell
                    ]);
                }
                ?>
        <?php } else { ?>
            <div class="text-center text-primary py-5 fs-3">
                Ничего не найдено
            </div>
        <?php } ?>
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



<button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer", ['render' => false])?>

<script src="/js/catalog.js"></script>

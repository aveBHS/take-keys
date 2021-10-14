<?php
/**
 * @var array $objects
 * @var array $images
 * @var bool $purchased
 **/

global $auth;
global $request;
?>

<?=view("layout.header", ["_page_title" => "Рекомендации недвижимости"])?>

<div class="container">
    <h1 class="h1 item__title my-2 my-lg-0">Заголовок категории</h1>
    <div class="h-48 fs-18">23 724 вариантов</div>

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
            <button class="btn btn-icon"><span class="catalog__view-list"></span></button>
        </div>
        <div class="col-auto">
            <button class="btn btn-icon"><span class="catalog__view-card"></span></button>
        </div>
    </div>

    <?php if($request->getCookie("catalog_view_mode") == "list") { ?>
        <div class="row g-4 row-cols-1 mb-4">
            <!--#set var="col-class" value="col" -->
            <!--#include virtual="/parts/catalog-item-list.html" -->
            <!--#include virtual="/parts/catalog-item-list.html" -->
        </div>
    <?php } else { ?>
        <!-- Отображение плитками -->
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            <?php
            foreach ($objects as $object) {
                //var_dump($object);
                echo view("objects.item", [
                    'object' => $object,
                    'images' => $object->images,
                    'col_class' => "col-9 col-lg-5"
                ]);
            }
            ?>
        </div>
    <?php } ?>

    <div class="mt-4">
        <!--#include virtual="/parts/pagination.html" -->
    </div>
</div>



<button class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>
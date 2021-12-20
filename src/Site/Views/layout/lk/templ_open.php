<?php
/**
 * @var string $current_page
 */
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-12">

            <div class="item__owner my-4 active">
                <div class="item__owner__avatar">
                    <img src="/images/dist/ava.png" alt="">
                    <div class="item__owner__photo">
                        <img src="/images/icons/photo.svg" alt="">
                    </div>
                </div>
                <div class="ms-3 text-start">
                    <div class="fw-semibold">Иван</div>
                    <div class="fw-normal fs-14">На сервисе недавно</div>
                </div>
            </div>

            <div class="list-group lk">

                <a href="/catalog/recent" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==UNDEFINED_PAGE?'active':''?>">
                    Недавно просмотренные
                    <span class="badge bg-primary rounded-pill">14</span>
                </a>

                <a href="/catalog/favorites" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==UNDEFINED_PAGE?'active':''?>">
                    Избранное
                    <span class="badge bg-primary rounded-pill">1</span>
                </a>

                <a href="/catalog/recommendations" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==UNDEFINED_PAGE?'active':''?>">
                    Рекомендованные
                    <span class="badge bg-primary rounded-pill"></span>
                </a>

                <a href="/notifies" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==LK_NOTIFIES_PAGE?'active':''?>">
                    Уведомления
                    <span class="badge bg-primary rounded-pill"></span>
                </a>

                <a href="/services" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==UNDEFINED_PAGE?'active':''?>">
                    Услуги
                    <span class="badge bg-primary rounded-pill"></span>
                </a>

                <a href="/documents" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==UNDEFINED_PAGE?'active':''?>">
                    Документы
                    <span class="badge bg-primary rounded-pill"></span>
                </a>

            </div>

        </div>
        <div class="col-lg-9 col-12">
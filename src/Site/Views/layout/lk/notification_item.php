<?php
/**
 * @var array $notify
 */
?>
<div class="lk-notifications__item rounded p-3 mb-3">
    <div class="row gx-3">
        <div class="col-md col-12 me-auto mb-4 mb-md-0">
            <div class="lk-notifications__item__title fw-bold"><?=$notify->object->title?> (<?=$notify->object->cost?> руб)</div>
            <div class="lk-notifications__item__title fw-bold">Мы проверили собственника, теперь вы можете
                связаться с ним</div>
            <div class="lk-notifications__item__link">
                <a href="/id/<?=$notify->object_id?>" target="_blank" class="link-dark fw-light">Смотреть объявление</a>
            </div>
        </div>
        <div class="col-md-auto col-6">
            <button class="btn btn-primary px-4 w-100" onclick="getPhone(<?=$notify->id?>);">Позвонить</button>
        </div>
        <div class="col-md-auto col-6">
            <a href="https://take-keys.com/booking" target="_blank"><button class="btn btn-dark px-4 w-100">Забронировать</button></a>
        </div>
    </div>
</div>

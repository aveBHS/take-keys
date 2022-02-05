<?php
/**
 * @var array $notify
 */
?>
<div class="lk-notifications__item rounded p-3 mb-3">
    <div class="row gx-3">
        <div class="col-md col-12 me-auto mb-4 mb-md-0">
            <div class="lk-notifications__item__title fw-bold"><?=$notify->title?></div>
            <div class="lk-notifications__item__title">
                <?=$notify->content?>
            </div>
            <div class="lk-notifications__item__link">
                <?=$notify->link?>
            </div>
        </div>

        <!--div class="col-md-auto col-6 d-flex flex-column justify-content-center">
            <button class="btn btn-danger px-4 w-100 text-light" onclick="cancel_request(<?=$notify->object->id?>);">Отменить</button>
        </div-->
        <?=$notify->buttons?>

    </div>
</div>

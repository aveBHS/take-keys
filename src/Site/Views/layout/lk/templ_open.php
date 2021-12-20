<?php
/**
 * @var string $current_page
 */

global $auth;
global $request;
try{
    $join_date = "c ".strtolower(date("d M", (new DateTime($auth()->joined))->getTimestamp()));
    foreach(MONTHS_RP as $key=>$value){
        $join_date = str_replace($key, $value, $join_date);
    }
} catch (Exception $exception){
    $join_date = "недавно";
}

$recently_viewed = $request->getCookie("recently_viewed", true);
try {
    $recently_viewed = json_decode($recently_viewed);
    if (is_null($recently_viewed)) {
        $recently_viewed = 0;
    } else {
        $recently_viewed = count($recently_viewed);
    }
} catch (\Exception $exception) {
    $recently_viewed = 0;
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-12">

            <div class="item__owner my-4 active">
                <div class="item__owner__avatar">
                    <img src="/images/dist/ava.png" alt="">
                </div>
                <div class="ms-3 text-start">
                    <div class="fw-semibold"><?=$auth()->name?></div>
                    <div class="fw-normal fs-14">На сервисе <?=$join_date?></div>
                </div>
            </div>

            <div class="list-group lk">

                <a href="/catalog/recent" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==LK_RECENT_PAGE?'active':''?>">
                    Недавно просмотренные
                    <span class="badge bg-primary rounded-pill"><?=$recently_viewed>0?$recently_viewed:''?></span>
                </a>

                <a href="/catalog/favorites" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==LK_FAVORITES_PAGE?'active':''?>">
                    Избранное
                    <?php if(!empty($auth()->request->favorites)) { ?>
                        <span class="badge bg-primary rounded-pill"><?=count(explode(",", $auth()->request->favorites))?></span>
                    <?php } ?>
                </a>

                <a href="/catalog/recommendations" class="list-group-item d-flex justify-content-between align-items-center py-3 list-group-item-action <?=$current_page==LK_RECOMMENDATIONS_PAGE?'active':''?>">
                    Рекомендованные
                    <?php if(!empty($auth()->request->recommendations)) { ?>
                        <span class="badge bg-primary rounded-pill"><?=count(explode(",", $auth()->request->recommendations))?></span>
                    <?php } ?>
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
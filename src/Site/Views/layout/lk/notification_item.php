<?php
/**
 * @var array $notify
 */
?>
<div class="lk-notifications__item rounded p-3 mb-3">
    <div class="row gx-3">
        <div class="col-md col-12 me-auto mb-4 mb-md-0">
            <div class="lk-notifications__item__title fw-bold"><?=$notify->object->title?> (<?=$notify->object->cost?> руб)</div>
            <div class="lk-notifications__item__title">
                <?php if($notify->result->call_status == OBJECT_CALL_DONE) { ?>
                    <?php if($notify->result->result_id == OBJECT_CALL_RESULT_IRRELEVANT) { ?>
                        Объект не актуальный, владелец закрыл объявление.<br>
                        Время последней проверки: <?=date("d.m.Y в H:i", $notify->result->result_time)?>
                    <?php } else if (in_array($notify->result->result_id, [OBJECT_CALL_RESULT_ACTUAL_HAVE_COMMISSION, OBJECT_CALL_RESULT_AGENT])) { ?>
                        Объект на модерации, наш робот распознал ключевую фразу по которой мы определяем агентов, возможно это агент, по этому объект передан на ручную модерацию.
                        Время последней проверки: 25.12.2021 20:46
                    <?php } else if ($notify->result->result_id == OBJECT_CALL_RESULT_ACTUAL) { ?>
                        Объект актуальный, можете связаться с владельцем.<br>
                        Время последней проверки: <?=date("d.m.Y в H:i", $notify->result->result_time)?>
                    <?php } else { ?>
                        Произошла ошибка при проверке объекта, пожалуйста, свяжитесь с <a href="#" onclick="Chatra('openChat', true)">поддержкой</a>
                    <?php } ?>
                <?php } else if (in_array($notify->result->call_status, [OBJECT_CALL_IN_PROCESS, OBJECT_CALL_NEW])) { ?>
                    <span class="fw-bold">Статус проверки: </span>Совершается звонок собственнику
                <?php } else if ($notify->result->call_status == OBJECT_CALL_RETRY) { ?>
                    <span class="fw-bold">Статус проверки: </span>Мы не смогли дозовниться до собственника, следующая попытка вызова будет <?=date("d.m.Y в H:i", $notify->result->next_attempt)?>
                <?php } else if ($notify->result->call_status == OBJECT_CALL_FAILED) { ?>
                    Мы не смогли связаться с собственником, возможно объявление устарело, попробуйте отправить заявку по этому объекту позднее
                <?php } ?>
            </div>
            <div class="lk-notifications__item__link">
                <a href="/id/<?=$notify->object_id?>" target="_blank" class="link-dark fw-light">Смотреть объявление</a>
            </div>
        </div>
        <?php if($notify->result->call_status == OBJECT_CALL_DONE) { ?>
            <?php if ($notify->result->result_id == OBJECT_CALL_RESULT_ACTUAL) { ?>
                <div class="col-md-auto col-6 d-flex flex-column justify-content-center">
                    <button class="btn btn-primary px-4 w-100" onclick="getPhone(<?=$notify->id?>);">Позвонить</button>
                </div>
                <div class="col-md-auto col-6 d-flex flex-column justify-content-center">
                    <a href="https://take-keys.com/booking" target="_blank"><button class="btn btn-dark px-4 w-100">Забронировать</button></a>
                </div>
            <?php } ?>
        <?php } else if (in_array($notify->result->call_status, [OBJECT_CALL_IN_PROCESS, OBJECT_CALL_NEW])) { ?>
            <div class="col-md-auto col-6 d-flex flex-column justify-content-center">
                <button class="btn btn-danger px-4 w-100 text-light" onclick="cancel_request(<?=$notify->object->id?>);">Отменить</button>
            </div>
        <?php } else if ($notify->result->call_status == OBJECT_CALL_RETRY) { ?>
            <div class="col-md-auto col-6 d-flex flex-column justify-content-center">
                <button class="btn btn-danger px-4 w-100 text-light" onclick="cancel_request(<?=$notify->object->id?>);">Отменить</button>
            </div>
        <?php } else if ($notify->result->call_status == OBJECT_CALL_FAILED) { ?>
            <!--div class="col-md-auto col-6 d-flex flex-column justify-content-center">
                <button class="btn btn-dark px-4 w-100 text-light">Повторить попытку</button>
            </div-->
        <?php } ?>
    </div>
</div>

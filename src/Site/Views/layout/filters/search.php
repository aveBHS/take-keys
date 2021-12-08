<?php
/**
 * @var array $objects_types
 */

global $request;
$current_object_type = $request->get("filter-object-type") ?? "Вся недвижимость";
?>

<form class="filter btn-group">
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Местоположение</div>
                    <div class="filter__item__name"><?=is_null($request->get("filter-address")) ? "Москва":$request->get("filter-address")?></div>
                    <input type="hidden" name="filter-address" value="<?=is_null($request->get("filter-address")) ? "Москва":$request->get("filter-address")?>"/>
                    <input type="hidden" name="geo_lon" value="<?=is_null($request->get("geo_lon")) ? 0:(float)$request->get("geo_lon")?>"/>
                    <input type="hidden" name="geo_lat" value="<?=is_null($request->get("geo_lat")) ? 0:(float)$request->get("geo_lat")?>"/>
                </div>
                <div class="ms-3"><span class="btn filter-my-location"><img src="/images/icons/location.svg"></span></div>
            </div>
        </button>
        <ul class="dropdown-menu filter__item__list">
            <li><input type="text" class="form-control filter__item__location address-autocomplete" placeholder="Введите адрес..."/></li>
            <li>
                <div class="p-3">
                    <div class="fs-14 fw-semibold mb-1">Радиус поиска:</div>
                    <input type="text" class="js-range-filter-radius js-range-slider" name="filter-radius" value=""
                           data-min="0.5"
                           data-max="20"
                           data-from="<?=is_null($request->get("filter-radius")) ? 5:(int)$request->get("filter-radius")?>"
                           data-grid="true"
                           data-step="0.5"
                           data-postfix=" км"
                    />
                </div>
            </li>
            <div class="address-autocomplete__list">
            </div>
        </ul>
    </div>

    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Тип жилья</div>
                    <div class="filter__item__name">Вся недвижимость</div>
                </div>
                <div class="ms-3"><img src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div class="btn-group-vertical select-list">

                <input <?=$current_object_type=="Вся недвижимость"?"checked":""?> type="radio" class="btn-check" name="filter-object-type" id="filter-value-0" autocomplete="off" value="Вся недвижимость">
                <label class="btn btn-outline-light filter__item__val" for="filter-value-0">Вся недвижимость</label>

                <?php for($i = 0; $i < count($objects_types); $i++){ $object_type = $objects_types[$i]; ?>

                    <input <?=$current_object_type==$object_type->object_type_slug?"checked":""?> type="radio" class="btn-check" name="filter-object-type" id="filter-value-<?=$i+1?>" autocomplete="off" value="<?=$object_type->object_type_slug?>">
                    <label class="btn btn-outline-light filter__item__val" for="filter-value-<?=$i+1?>"><?=$object_type->object_type_slug?></label>

                <?php } ?>

            </div>
        </div>
    </div>

    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Цена</div>
                    <div class="filter__item__name"><span class="text-nowrap filter__price-value">Любая</span></div>
                </div>
                <div class="ms-3"><img src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">

            <div class="filter__price-range">
                <input type="text" class="js-range-filter" name="filter-price" value=""
                       data-type="int"
                       data-min="500"
                       data-max="200000"
                       data-from="<?=is_null($request->get("filter-price")) ? 500:(int)explode(";", $request->get("filter-price"))[0]?>"
                       data-to="<?=is_null($request->get("filter-price")) ? 200000:(int)explode(";", $request->get("filter-price"))[1]?>"
                       data-grid="true"
                       data-step="500"
                       data-postfix=" ₽"
                />
            </div>

        </div>
    </div>

    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Количество комнат</div>
                    <div class="filter__item__name">Любое</div>
                </div>
                <div class="ms-3"><img src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div class="btn-group-vertical select-list">
                <input type="radio" class="btn-check" name="filter-rooms" id="filter-value-13" autocomplete="off" value="Любое" <?=(int)$request->get("filter-rooms")==0?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-13">Любое</label>

                <input type="radio" class="btn-check" name="filter-rooms" id="filter-value-9" autocomplete="off" value="1" <?=(int)$request->get("filter-rooms")==1?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-9">1</label>

                <input type="radio" class="btn-check" name="filter-rooms" id="filter-value-10" autocomplete="off" value="2" <?=(int)$request->get("filter-rooms")==2?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-10">2</label>

                <input type="radio" class="btn-check" name="filter-rooms" id="filter-value-11" autocomplete="off" value="3+" <?=(int)$request->get("filter-rooms")==3?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-11">3+</label>
            </div>
        </div>
    </div>
    <div class="btn-group filter__item border d-flex align-items-center p-3">
        <button type="submit" class="ms-auto btn btn-primary rounded-pill px-4 flex-grow-0">Найти</button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // $('.filter').submit(function (e) {
        //     e.preventDefault();
        //     filterSend()
        // });

        $('.filter-my-location').click(function (e) {
            e.preventDefault();
            e.stopPropagation()
        });

        $('.filter input').change(function (e) {
            e.preventDefault();
        });

        $('body').on('click', '.filter__item__val', function () {
            $(this).parents('.filter__item').find('.filter__item__name').html($(this).html())
        })

        $('.filter__item__list [type="radio"]:checked').each(function () {
            $(this).parents('.filter__item').find('.filter__item__name').html($(this).val())
        })

        $('body').on('click', '.address-autocomplete__list .filter__item__val', function () {
            const parent = $(this).parents('.filter__item')
            parent.find('[name="filter-address"]').val($(this).html())
            parent.find('[name="geo_lon"]').val($(this).attr('data-geo_lon'))
            parent.find('[name="geo_lat"]').val($(this).attr('data-geo_lat'))
        })
    })
</script>
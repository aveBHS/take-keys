<?php
/**
 * @var array $objects_types
 */

global $request;
$current_object_type = $request->get("filter-object-type") ?? [];
$current_object_rooms = $request->get("filter-rooms") ?? [];
?>

<form class="filter btn-group">
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" onclick="$('.filter__item__location').focus()" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <!-- <div class="fs-14 fw-semibold">Местоположение</div> -->
                    <div class="filter__item__name">Местоположение</div>
                    <input type="hidden" name="filter-address" value="<?=is_null($request->get("filter-address")) ? "Москва":$request->get("filter-address")?>"/>
                    <input type="hidden" name="geo_lon" value="<?=is_null($request->get("geo_lon")) ? 0:(float)$request->get("geo_lon")?>"/>
                    <input type="hidden" name="geo_lat" value="<?=is_null($request->get("geo_lat")) ? 0:(float)$request->get("geo_lat")?>"/>
                </div>
                <div class="ms-3"><span class="btn filter-my-location"><img src="/images/icons/location.svg"></span></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div>
                <button class="btn btn-primary w-100" type="submit">Применить</button>
            </div>
            <div><input type="text" class="form-control filter__item__location address-autocomplete border-primary" placeholder="Введите адрес..." value="<?=is_null($request->get("filter-address")) ? "":$request->get("filter-address")?>"/></div>
            <div class="address-autocomplete__list"></div>
        </div>
    </div>
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Радиус поиска</div>
                    <div class="filter__item__name filter__radius-value">5км</div>
                </div>
                <div class="ms-3"><img class="filter__item__arrow" src="images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list w-100">
            <div>
                <button class="btn btn-primary w-100" type="submit">Применить</button>
            </div>
            <div class="p-3">
                <input type="text" class="js-range-filter-radius" name="filter-radius" value=""
                       data-min="0.5"
                       data-max="20"
                       data-from="<?=is_null($request->get("filter-radius")) ? 5:(int)$request->get("filter-radius")?>"
                       data-grid="true"
                       data-step="0.5"
                       data-postfix=" км"
                />
            </div>
        </div>
    </div>
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <!-- <div class="fs-14 fw-semibold">Тип жилья</div> -->
                    <div class="filter__item__name">Тип жилья</div>
                </div>
                <div class="ms-3"><img class="filter__item__arrow" src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div>
                <button class="btn btn-primary w-100" type="submit">Применить</button>
            </div>
            <div class="btn-group-vertical select-list">
                <input type="checkbox" class="btn-check" name="filter-object-type[]" <?=(empty($current_object_type) || in_array("any", $current_object_type))?"checked":""?> value="any" id="filter-value-0" autocomplete="off">
                <label class="btn btn-outline-light filter__item__val text-nowrap" for="filter-value-0">Вся недвижимость</label>

                <?php for($i = 0; $i < count($objects_types); $i++){ $object_type = $objects_types[$i]; ?>

                    <input <?=in_array($object_type->object_type_slug, $current_object_type)?"checked":""?> type="checkbox" class="btn-check" name="filter-object-type[]" id="filter-value-<?=$i+1?>" autocomplete="off" value="<?=$object_type->object_type_slug?>">
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
                <div class="ms-3"><img class="filter__item__arrow" src="images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div>
                <button class="btn btn-primary w-100" type="submit">Применить</button>
            </div>

            <div class="filter__price-range">
                <input type="text" class="js-range-filter-price" name="filter-price" value=""
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
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <!-- <div class="fs-14 fw-semibold">Количество комнат</div> -->
                    <div class="filter__item__name">Количество комнат</div>
                </div>
                <div class="ms-3"><img class="filter__item__arrow" src="images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div>
                <button class="btn btn-primary w-100" type="submit">Применить</button>
            </div>
            <div class="btn-group-vertical select-list">
                <input type="checkbox" class="btn-check" name="filter-rooms[]" value="any" id="filter-value-13" autocomplete="off" <?=(empty($current_object_rooms) || in_array("any", $current_object_rooms))?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-13">Любое</label>

                <input type="checkbox" class="btn-check" name="filter-rooms[]" value="1" id="filter-value-9" autocomplete="off" <?=in_array("1", $current_object_rooms)?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-9">1</label>

                <input type="checkbox" class="btn-check" name="filter-rooms[]" value="2" id="filter-value-10" autocomplete="off" <?=in_array("2", $current_object_rooms)?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-10">2</label>

                <input type="checkbox" class="btn-check" name="filter-rooms[]" value="3" id="filter-value-11" autocomplete="off" <?=in_array("3", $current_object_rooms)?"checked":""?>>
                <label class="btn btn-outline-light filter__item__val" for="filter-value-11">3</label>
            </div>
        </div>
    </div>
    <div class="btn-group filter__item border d-flex align-items-center p-3 ps-lg-0 flex-grow-0">
        <button type="button" class="btn filter__addictional flex-grow-0"><img src="images/icons/filter.svg"></button>
        <button type="submit" class="ms-auto btn btn-primary rounded-pill px-4 flex-grow-0">Найти</button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        $('.filter').submit(function (e) {
            Dropdown.getInstance($('.filter__item__btn.show')).hide()
            e.preventDefault();
        });

        $('.filter-my-location').click(function (e) {
            e.preventDefault();
            e.stopPropagation()
        });

        $('.filter input').change(function (e) {
            e.preventDefault();
        });

        // $('body').on('click', '.filter__item__val', function () {
        // 	$(this).parents('.filter__item').find('.filter__item__name').html($(this).html())
        // })

        // $('.filter__item__list [type="radio"]:checked').each(function () {
        // 	$(this).parents('.filter__item').find('.filter__item__name').html($(this).val())
        // })

        $('body').on('click', '.address-autocomplete__list .filter__item__val', function () {
            const parent = $(this).parents('.filter__item')
            //parent.find('.filter__item__name').html($(this).html())
            parent.find('.filter__item__location').val($(this).html())
            parent.find('[name="filter-address"]').val($(this).html())
            parent.find('[name="geo_lon"]').val($(this).attr('data-geo_lon'))
            parent.find('[name="geo_lat"]').val($(this).attr('data-geo_lat'))
        })
    })
</script>
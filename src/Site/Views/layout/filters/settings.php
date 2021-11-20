<?php
/**
 * @var array $objects_types
 */

global $auth;
$request = $auth()->request;
$current_object_type = Null;
foreach ($objects_types as $object_type){
    if($object_type->object_type_id == $request->object_type){
        $current_object_type = $object_type;
    }
}
?>

<form class="filter btn-group">
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Местоположение</div>
                    <div class="filter__item__name"><?=$request->address?></div>
                    <input type="hidden" name="filter-address" value="<?=$request->address?>"/>
                    <input type="hidden" name="geo_lon" value="<?=$request->lng?>"/>
                    <input type="hidden" name="geo_lat" value="<?=$request->lat?>"/>
                </div>
                <div class="ms-3"><span class="btn filter-my-location"><img src="/images/icons/location.svg"></span></div>
            </div>
        </button>
        <ul class="dropdown-menu filter__item__list">
            <li><input type="text" class="form-control filter__item__location address-autocomplete" placeholder="Введите адрес..."/></li>
            <li>
                <div class="p-3">
                    <div class="fs-14 fw-semibold mb-1">Радиус поиска:</div>
                    <input type="text" class="js-range-filter-radius js-range-slider" name="filter-radius" value="<?=(int)$request->distance/1000?>"
                           data-min="0.5"
                           data-max="20"
                           data-from="<?=(int)$request->distance/1000?>"
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
    <!-- <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Категория</div>
                    <div class="filter__item__name">Аренда</div>
                </div>
                <div class="ms-3"><img src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div class="btn-group-vertical select-list">
                <input type="radio" class="btn-check" name="filter-category" id="filter-value-1" autocomplete="off" value="Аренда" checked="">
                <label class="btn btn-outline-light filter__item__val" for="filter-value-1">Аренда</label>
                <input type="radio" class="btn-check" name="filter-category" id="filter-value-2" value="Покупка" autocomplete="off">
                <label class="btn btn-outline-light filter__item__val" for="filter-value-2">Покупка</label>
            </div>
        </div>
    </div> -->
    <div class="btn-group filter__item">
        <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="fs-14 fw-semibold">Тип жилья</div>
                    <div class="filter__item__name"><?=$current_object_type->object_type_slug?></div>
                </div>
                <div class="ms-3"><img src="/images/icons/arrow-down.svg"></div>
            </div>
        </button>
        <div class="dropdown-menu filter__item__list">
            <div class="btn-group-vertical select-list">


                <?php for($i = 0; $i < count($objects_types); $i++){ $object_type = $objects_types[$i]; ?>

                <input <?=$current_object_type->object_type_id==$object_type->object_type_id?"checked":""?> type="radio" class="btn-check" name="filter-object-type" id="filter-value-<?=$i?>" autocomplete="off" value="<?=$object_type->object_type_slug?>">
                <label class="btn btn-outline-light filter__item__val" for="filter-value-<?=$i?>"><?=$object_type->object_type_slug?></label>

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
                       data-from="<?=(int)$request->price_min?>"
                       data-to="<?=(int)$request->price_max?>"
                       data-grid="true"
                       data-step="500"
                       data-postfix=" ₽"
                />
            </div>

        </div>
    </div>

    <div class="btn-group filter__item border d-flex align-items-center p-3">
        <button type="submit" class="ms-auto btn btn-primary rounded-pill px-4 flex-grow-0">Сохранить параметры</button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        $('.filter').submit(function (e) {
            e.preventDefault();
            filterSend();
        });

        $('.filter-my-location').click(function (e) {
            e.preventDefault();
            e.stopPropagation()
        });

        $('.filter input').change(function (e) {
            e.preventDefault();
        });

        function filterSend() {
            let form = $('form.filter')
            $.ajax({
                type: 'POST',
                url: '/api/user/filter/',
                data: form.serialize(),
            }).done(function (data) {
                if(data['result'] === "OK"){
                    swal({
                        title: "Подбор объектов",
                        text: "Пожалуйста, подождите",
                        icon: "info",
                        buttons: false
                    });
                    setTimeout(() => {
                        swal("Успешно", "Настройки сохранены, в скором времени мы подберем для вас новые варианты", "success").then(() => {
                            window.location.reload();
                        });
                    }, 1500);
                } else if(data['result'] === "ERROR"){
                    swal({
                        title: "Ошибка",
                        text: data['reason'],
                        icon: "error",
                        buttons: ["Поддержка", "ОК"]
                    }).then(data => {if(!data) Chatra('openChat', true);});
                } else {
                    swal({
                        title: "Ошибка",
                        text: "Произошла неизвестная ошибка, обратитесь в техническую поддержку",
                        icon: "error",
                        button: "Поддержка"
                    }).then(data => {if(data) Chatra('openChat', true);});
                }
            })
        }

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
<?php
/**
 * @var object $request
 **/

global $auth;
?>

<?=view("layout.header", [
    "_page_title"    => "Личный Кабинет | Take-Keys",
    "_custom_button" => ["logout", "Выход"]
])?>

<style>
    span.active{
        display: none;
    }
    .setting-item.active span.active{
        display: inline;
    }
    .setting-item.active span{
        display: none;
    }
</style>

<div class="main-container container mt-5">
    <h1>Настройка персональной подборки</h1><br>
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-3 gy-3">

        <form class="filter btn-group">
            <div class="btn-group filter__item">
                <button type="button" class="btn btn-outline-light filter__item__btn" onclick="$('.filter__item__location').focus()" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="filter__item__name">Местоположение</div>
                            <div class="filter__item__name">Москва</div>
                            <input type="hidden" name="filter-address" value="Москва"/>
                            <input type="hidden" name="geo_lon"/>
                            <input type="hidden" name="geo_lat"/>
                        </div>
                        <div class="ms-3"><span class="btn filter-my-location"><img src="images/icons/location.svg"></span></div>
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
                                   data-from="5"
                                   data-grid="true"
                                   data-step="0.5"
                                   data-postfix=" км"
                            />
                        </div>
                    </li>
                    <div class="dropdown-menu filter__item__list">
                        <div>
                            <button class="btn btn-primary w-100" type="submit">Найти</button>
                        </div>
                        <div><input type="text" class="form-control filter__item__location address-autocomplete border-primary" placeholder="Введите адрес..."/></div>
                        <div class="address-autocomplete__list"></div>
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
                        <div class="ms-3"><img src="images/icons/arrow-down.svg"></div>
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
                <button type="button" class="btn btn-outline-light filter__item__btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="fs-14 fw-semibold">Тип жилья</div>
                            <div class="filter__item__name">Вся недвижимость</div>
                        </div>
                        <div class="ms-3"><img src="images/icons/arrow-down.svg"></div>
                    </div>
                </button>
                <div class="dropdown-menu filter__item__list">
                    <div class="btn-group-vertical select-list">
                        <input type="radio" class="btn-check" name="filter-type" id="filter-value-3" autocomplete="off" value="Вся недвижимость" checked="">
                        <label class="btn btn-outline-light filter__item__val" for="filter-value-3">Вся недвижимость</label>

                        <input type="radio" class="btn-check" name="filter-type" id="filter-value-4" autocomplete="off" value="Комната">
                        <label class="btn btn-outline-light filter__item__val" for="filter-value-4">Комната</label>

                        <input type="radio" class="btn-check" name="filter-type" id="filter-value-5" autocomplete="off" value="Квартира">
                        <label class="btn btn-outline-light filter__item__val" for="filter-value-5">Квартира</label>

                        <input type="radio" class="btn-check" name="filter-type" id="filter-value-6" autocomplete="off" value="Студия">
                        <label class="btn btn-outline-light filter__item__val" for="filter-value-6">Студия</label>

                        <input type="radio" class="btn-check" name="filter-type" id="filter-value-7" autocomplete="off" value="Дом">
                        <label class="btn btn-outline-light filter__item__val" for="filter-value-7">Дом</label>

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
                        <div class="ms-3"><img src="images/icons/arrow-down.svg"></div>
                    </div>
                </button>
                <div class="dropdown-menu filter__item__list">

                    <div class="filter__price-range">
                        <input type="text" class="js-range-filter" name="filter-price" value=""
                               data-type="int"
                               data-min="500"
                               data-max="200000"
                               data-from="500"
                               data-to="200000"
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
                    filterSend()
                });

                $('.filter-my-location').click(function (e) {
                    e.preventDefault();
                    e.stopPropagation()
                });

                $('.filter input').change(function (e) {
                    e.preventDefault();
                    filterSend()
                });

                function filterSend() {
                    let form = $('form.filter')
                    $.ajax({
                        type: 'POST',
                        url: 'https://take-keys.ru/api/filter/',
                        data: form.serialize(),
                    }).done(function (data) {

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

        <div class="col">
            <div class="setting-item">
                <div class="setting-item__icon">
                    <button class="btn btn-primary btn-icon btn-aura">
                        <i class="icon"><img src="/images/icons/home.svg"></i>
                    </button>
                </div>
                <div class="setting-item__title mt-5">
                    <span>Персонализированная подборка</span>
                </div>
                <div class="setting-item__btn ">
                    <form action="/catalog/recommendations">
                        <button class="btn text-dark btn-outline-dark rounded-pill px-4 mt-3 btn-switch">
                            <span>Смотреть рекомендованные</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="setting-item">
                <div class="setting-item__icon">
                    <button class="btn btn-primary btn-icon btn-aura">
                        <i class="icon"><img src="/images/icons/heart.svg"></i>
                    </button>
                </div>
                <div class="setting-item__title mt-5">
                    <span>Избранные объекты</span>
                </div>
                <div class="setting-item__btn ">
                    <form action="/catalog/favorites">
                        <button class="btn text-dark btn-outline-dark rounded-pill px-4 mt-3 btn-switch">
                            <span>Смотреть список</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer")?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('.btn-switch').click(function(e) {
            $.ajax({"url": "/api/rec/", "method": "POST"});
            $(this).parents('.setting-item').toggleClass('active')
        })
    })
</script>

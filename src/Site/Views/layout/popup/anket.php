<?php
/**
 * @var bool $continue
 */

global $auth;
$d = DateTime::createFromFormat('Y-m-d H:i:s', $auth()->joined);
if ($d === false) {
    $free_contact_at = "";
} else {
    $free_contact_at = date("H:i", $d->getTimestamp()+8532);
}


?>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        if (<?=$continue ? "true" : "false"?>) {
            Modal.getOrCreateInstance($('#popup-msg-1')).show()
        }

        $('#anket_form').submit(function (event) {
            event.preventDefault()
            event.stopPropagation()

            let form = $('#anket_form')
            $.post({
                type: 'POST',
                url: '/api/user/anket/',
                data: form.serialize(),
            }).done(function (data) {
                Modal.getOrCreateInstance($('#popup-owner-questions')).hide()
                Modal.getOrCreateInstance($('#popup-notification')).show()
            });
        });

        $('#popup-msg-1')[0].addEventListener('hide.bs.modal', function (event) {
            window.location.reload();
        })
    });

    function showPay(){
        Modal.getOrCreateInstance($('#popup-сontact-ads')).hide()
        Modal.getOrCreateInstance($('#popup-tarif-take-keys')).show()
    }
</script>

<div class="modal fade main-modal" id="popup-owner-message" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp" style="background: url('/images/dist/popup-bg/message.svg') no-repeat center center">
                <div class="popup__content">
                    <div class="popup__title">Автор объявления выбрал способ связи через сообщения</div>
                    <div class="popup__text text-center">Некоторым людям не всегда удобно принимать звонки в рабочее или личное время, а написать смс можно без труда</div>

                    <div class="popup__buttons">
                        <button class="btn btn-primary px-4" data-bs-target="#popup-owner-questions" data-bs-toggle="modal" data-bs-dismiss="modal">Отправить заявку</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade main-modal main-modal-steps" id="popup-owner-questions" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content h-auto">
            <div class="popup__wrp">
                <div class="popup__content">
                    <div class="popup__title">Все собственники, которые сдают жилье, похожее на то, что вы ищите, увидят вашу анкету</div>
                    <!-- Slider main container -->
                    <form id="anket_form">
                        <div class="modal-swiper" data-swiper-speed="500">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">Какой вид сделки Вы хотите предложить владельцу?</div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="offer-type" value="long-rent" id="owner-questions-1" checked>
                                            <label class="form-check-label" for="owner-questions-1">
                                                Длительная аренда
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="offer-type" value="one-day-rent" id="owner-questions-2">
                                            <label class="form-check-label" for="owner-questions-2">
                                                Посуточная аренда
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="offer-type" value="rent-and-buy" id="owner-questions-3">
                                            <label class="form-check-label" for="owner-questions-3">
                                                Аренда с выкупом
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="offer-type" value="buy" id="owner-questions-4">
                                            <label class="form-check-label" for="owner-questions-4">
                                                Покупка наличными
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="offer-type" value="mortgage" id="owner-questions-5">
                                            <label class="form-check-label" for="owner-questions-5">
                                                Покупка в ипотеку
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">Срок аренды?</div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="rent-period" value="1" id="owner-questions-6">
                                            <label class="form-check-label" for="owner-questions-6">
                                                До 1 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="rent-period" value="3" id="owner-questions-7">
                                            <label class="form-check-label" for="owner-questions-7">
                                                От 1 до 3-х мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="rent-period" value="6" id="owner-questions-8">
                                            <label class="form-check-label" for="owner-questions-8">
                                                От 3-х до 6 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="rent-period" value="12" id="owner-questions-9">
                                            <label class="form-check-label" for="owner-questions-9">
                                                От 6 до 12 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="rent-period" value="12+" id="owner-questions-10" checked>
                                            <label class="form-check-label" for="owner-questions-10">
                                                От 12+ мес.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">Кто будет проживать?</div>

                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="man" id="owner-questions-11" checked>
                                            <label class="form-check-label" for="owner-questions-11">
                                                Один парень
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="woman" id="owner-questions-12">
                                            <label class="form-check-label" for="owner-questions-12">
                                                Одна девушка
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="family-free-child" id="owner-questions-13">
                                            <label class="form-check-label" for="owner-questions-13">
                                                Семейная пара без детей
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="family" id="owner-questions-14">
                                            <label class="form-check-label" for="owner-questions-14">
                                                Семейная пара с детьми
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="animals" id="owner-questions-15">
                                            <label class="form-check-label" for="owner-questions-15">
                                                Есть животные
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="female-students" id="owner-questions-150">
                                            <label class="form-check-label" for="owner-questions-150">
                                                Девушки студентки
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="male-students" id="owner-questions-151">
                                            <label class="form-check-label" for="owner-questions-151">
                                                Парни студенты
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="residents[]" value="companions" id="owner-questions-152">
                                            <label class="form-check-label" for="owner-questions-152">
                                                Сотрудники
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">Национальность</div>

                                        <div class="btn-group-vertical select-list">
                                            <input type="radio" class="btn-check" name="nationality" value="slavs" id="owner-questions-16" autocomplete="off" checked>
                                            <label class="btn btn-outline-light" for="owner-questions-16">Славяне</label>
                                            <input type="radio" class="btn-check" name="nationality" value="tatar" id="owner-questions-17" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-17">Татары</label>
                                            <input type="radio" class="btn-check" name="nationality" value="chechens" id="owner-questions-19" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-19">Чеченцы</label>
                                            <input type="radio" class="btn-check" name="nationality" value="armens" id="owner-questions-21" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-21">Армяне</label>
                                            <input type="radio" class="btn-check" name="nationality" value="azerbaijan" id="owner-questions-22" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-22">Азербайджанцы</label>
                                            <input type="radio" class="btn-check" name="nationality" value="kazakhs" id="owner-questions-23" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-23">Казахи</label>
                                            <input type="radio" class="btn-check" name="nationality" value="another" id="owner-questions-24" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-24">Другие</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">Предложение по цене</div>
                                        <div class="popup__text">Предлагая большую сумму, вы значительно выделяетесь среди других соискателей</div>
                                        <div class="popup__text fw-semibold">Цена, ₽</div>

                                        <input type="text" class="js-range-slider" name="price-request" value=""
                                               data-min="500"
                                               data-max="200000"
                                               data-from="10000"
                                               data-to="50000"
                                               data-grid="true"
                                               data-step="500"
                                               data-postfix=" ₽"
                                        />

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="fs-4 mb-4">В какой день вам удобно встретиться?</div>

                                        <div class="mb-3">
                                            <input type="date" name="meet-date" placeholder="01.01.2022"
                                                   class="form-control" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--div class="row mb-3">
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-6" id="owner-questions-21" checked>
                                                    <label class="form-check-label fs-14" for="owner-questions-21">
                                                        Как можно быстрее
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-7" id="owner-questions-22">
                                                    <label class="form-check-label fs-14" for="owner-questions-22">
                                                        Сегодня
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-8" id="owner-questions-23">
                                                    <label class="form-check-label fs-14" for="owner-questions-23">
                                                        Завтра
                                                    </label>
                                                </div>
                                            </div>
                                        </div-->


                                        <div class="fs-4 mb-4 mt-5">Укажите время встречи</div>
                                        <div class="mb-3">
                                            <input type="time" name="meet-time" placeholder="9:00"
                                                   class="form-control" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <!--div class="row mb-3">
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-11" id="owner-questions-24" checked>
                                                    <label class="form-check-label fs-14" for="owner-questions-24">
                                                        В любое время
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-12" id="owner-questions-25">
                                                    <label class="form-check-label fs-14" for="owner-questions-25">
                                                        До 22:00
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="form-check form-check-box mb-2">
                                                    <input class="form-check-input" type="checkbox" value="" name="questions-13" id="owner-questions-26">
                                                    <label class="form-check-label fs-14" for="owner-questions-26">
                                                        После 8:00
                                                    </label>
                                                </div>
                                            </div>
                                        </div-->


                                    </div>
                                </div>
                            </div>
                            <div class="swiper-scrollbar"><div class="swiper-scrollbar-drag"></div></div>
                        </div>
                        <div class="popup__buttons position-relative">
                            <button class="btn btn-light px-4 px-lg-5 popup-owner-questions__next" type="button">Дальше</button>
                            <button class="btn btn-primary px-4 px-lg-5 popup-owner-questions__done" type="submit">Готово</button>
                            <button class="btn px-0 px-lg-4 position-absolute start-0 bottom-0 popup-owner-questions__back" type="button">Назад</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade main-modal" id="popup-msg-1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content h-auto">
            <div class="popup__wrp">
                <div class="popup__content align-items-center">

                    <img class="img-fluid mt-3 popup-msg-1__img" src="/images/dist/popup-bg/Security_on_re.png">
                    <div class="popup__title">Вы успешно создали анкету и мы отправили её собственникам</div>
                    <div class="popup__text mt-4 text-center popup-msg-1__text">
                        Обычно связь с владельцами устанавливается за 5-30 минут, но иногда нужно больше времени. Пожалуйста ожидайте, как только мы получим информацию - моментально вас уведомим.
                        <br>Кстати, мы уже подобрали вам подходящие варианты, чтобы вы удачно заселились
                    </div>

                    <div class="popup__buttons">
                        <a href="/catalog/recommendations"><button class="btn px-4 btn-primary mt-4 position-relative w-100" style="max-width: 500px">
                                <span class="fs-18">Смотреть похожие объявления</span>
                            </button></a>
                        <a href="https://take-keys.online/booking"><button class="btn px-4 btn-dark mt-1 position-relative w-100" style="max-width: 500px">
                                <span class="fs-18">Подробные условия онлайн бронирования</span>
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
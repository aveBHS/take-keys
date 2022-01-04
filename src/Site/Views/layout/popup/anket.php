<script>
    document.addEventListener('DOMContentLoaded', () => {

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
                Modal.getOrCreateInstance($('#popup-msg-1')).show()
            });
        });
    });
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
        <div class="modal-content">
            <div class="popup__wrp">
                <div class="popup__content">
                    <div class="popup__title">Для более конкретного общения с владельцем ответьте на несколько вопросов</div>
                    <!-- Slider main container -->
                    <form id="anket_form">
                        <div class="modal-swiper" data-swiper-speed="500">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="popup__subtitle mb-4">Какой вид сделки Вы хотите предложить владельцу?</div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-1" id="owner-questions-1" checked>
                                            <label class="form-check-label" for="owner-questions-1">
                                                Длительная аренда
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-1" id="owner-questions-2">
                                            <label class="form-check-label" for="owner-questions-2">
                                                Посуточная аренда
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-1" id="owner-questions-3">
                                            <label class="form-check-label" for="owner-questions-3">
                                                Аренда с выкупом
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-1" id="owner-questions-4">
                                            <label class="form-check-label" for="owner-questions-4">
                                                Покупка наличными
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-1" id="owner-questions-5">
                                            <label class="form-check-label" for="owner-questions-5">
                                                Покупка в ипотеку
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="popup__subtitle">Срок аренды?</div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-2" id="owner-questions-6" checked>
                                            <label class="form-check-label" for="owner-questions-6">
                                                До 1 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-2" id="owner-questions-7">
                                            <label class="form-check-label" for="owner-questions-7">
                                                От 1 до 3-х мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-2" id="owner-questions-8">
                                            <label class="form-check-label" for="owner-questions-8">
                                                От 3-х до 6 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-2" id="owner-questions-9">
                                            <label class="form-check-label" for="owner-questions-9">
                                                От 6 до 12 мес.
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="questions-2" id="owner-questions-10">
                                            <label class="form-check-label" for="owner-questions-10">
                                                От 12+ мес.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="popup__subtitle">С кем будете проживать?</div>

                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="questions-3" id="owner-questions-11" checked>
                                            <label class="form-check-label" for="owner-questions-11">
                                                С детьми
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="questions-3" id="owner-questions-12">
                                            <label class="form-check-label" for="owner-questions-12">
                                                С животными
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="questions-3" id="owner-questions-13">
                                            <label class="form-check-label" for="owner-questions-13">
                                                С компанией
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="questions-3" id="owner-questions-14">
                                            <label class="form-check-label" for="owner-questions-14">
                                                Один
                                            </label>
                                        </div>
                                        <div class="form-check form-check-box mb-3">
                                            <input class="form-check-input" type="checkbox" name="questions-3" id="owner-questions-15">
                                            <label class="form-check-label" for="owner-questions-15">
                                                Еще не знаю
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="popup__subtitle">Национальность</div>

                                        <div class="btn-group-vertical select-list">
                                            <input type="radio" class="btn-check" name="questions-4" id="owner-questions-16" autocomplete="off" checked>
                                            <label class="btn btn-outline-light" for="owner-questions-16">Россия</label>
                                            <input type="radio" class="btn-check" name="questions-4" id="owner-questions-17" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-17">Беларусь</label>
                                            <input type="radio" class="btn-check" name="questions-4" id="owner-questions-18" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-18">Украина</label>
                                            <input type="radio" class="btn-check" name="questions-4" id="owner-questions-19" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-19">Грузия</label>
                                            <input type="radio" class="btn-check" name="questions-4" id="owner-questions-20" autocomplete="off">
                                            <label class="btn btn-outline-light" for="owner-questions-20">Другая</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="slider-content" style="background: none" data-swiper-parallax-opacity="0.0" data-swiper-parallax="50%">
                                        <div class="popup__subtitle">Предложение по цене</div>
                                        <div class="popup__text">Предлагая большую сумму, вы значительно выделяетесь среди других соискателей</div>
                                        <div class="popup__text fw-semibold">Цена, ₽</div>

                                        <input type="text" class="js-range-slider" name="questions-5" value=""
                                               data-type="int"
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
                                        <div class="popup__subtitle">В какой день вам удобно встретиться?</div>

                                        <div class="mb-3">
                                            <input type="date" name="questions-9" placeholder="19.10.2021"
                                                   class="form-control">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="row mb-3">
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
                                        </div>


                                        <div class="popup__subtitle mt-5">Укажите время встречи</div>
                                        <div class="mb-3">
                                            <input type="time" name="questions-10" placeholder="9:00"
                                                   class="form-control">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="row mb-3">
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
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="swiper-scrollbar"><div class="swiper-scrollbar-drag"></div></div>
                        </div>
                        <div class="popup__buttons position-relative">
                            <button class="btn btn-light px-4 px-lg-5 popup-owner-questions__next">Дальше</button>
                            <button class="btn btn-primary px-4 px-lg-5 popup-owner-questions__done">Готово</button>
                            <button class="btn px-0 px-lg-4 position-absolute start-0 bottom-0 popup-owner-questions__back">Назад</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade main-modal" id="popup-msg-1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp">
                <div class="popup__content align-items-center">

                    <img class="img-fluid mt-3 popup-msg-1__img" src="/images/dist/popup-bg/take-keys-circle.png">
                    <div class="popup__text mt-4 text-center popup-msg-1__text">
                        Информация обновляется каждую минуту, в Take keys вы получите в кратном колличестве больше актуальных вариантов, чем на любом сайте. Проверьте - это удобно и специально для вас, чтобы вы сохранил свое время, деньги и хорошее настроение).
                    </div>

                    <div class="popup__buttons">
                        <button class="btn btn-primary px-3" data-bs-target="#popup-tarif-take-keys" data-bs-toggle="modal" data-bs-dismiss="modal">Подключить тариф</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
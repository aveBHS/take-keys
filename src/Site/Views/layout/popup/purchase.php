<?php
/**
 * @var string $name
 */

$name = $name ?? "пользователь";
?>
<div class="modal fade main-modal" id="popup-tarif-max-1" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="popup__wrp px-lg-5">
                <div class="popup__content mw-100">
                    <div class="popup__title">Найдётся всё</div>
                    <div class="popup__text text-left">Уважаемый <?=$name?>, благодарим вас за интерес к Take Keys и искренне желаем удачного заселения. Сразу после оплаты тарифа "Найдётся всё" вам станут доступны все услуги. По статистике 98% пользователей заселяются в желаемый день.</div>
                    <div class="row gx-4 gy-2 row-cols-1 row-cols-md-2 mb-4">
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/activity-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Автоматический подбор подходящих вариантов</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/call-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Безграничный доступ и связь с владельцами</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/paper-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Образцы договоров найма</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/shield-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Максимальная гарантия заселения</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/rouble-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Торг уместен</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-3 align-items-center">
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-icon btn-aura pe-none">
                                        <i class="icon"><img src="/images/icons/operator-white.svg"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <div class="fs-14">Поддержка 24/7</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popup__buttons">
                        <p class="fs-14 text-start">Мы понимаем, что вы с нами еще не работали, и знаем, что в сфере недвижимости много недобросовестных участников рынка.
                            Поэтому, мы проверяем квартиры через ЕГРН, за счёт чего Ваше заселение в квартиру, выбранную на нашем сайте, будет безопасным.<br/>Чтобы заслужить ваше доверие, мы сначала предоставляем наши услуги (https://take-keys.com/praic) по поиску квартиры, а потом уже берем основную оплату.
                            В отличие от остальных мы работаем дистанционно и только до полного заселения, плюс вместо 100% от стоимости аренды, сборы за услуги сервиса фиксированные всего 99 руб на старте и 5791₽ по факту предоставления услуги.</p>
                        <a class="btn btn-dark px-5" data-bs-target="#popup-tarif-max-2" data-bs-toggle="modal" data-bs-dismiss="modal">Подключить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        $('#tarif-max__form').submit(function (event) {
            if (this.checkValidity()) {
                Modal.getOrCreateInstance($('#popup-tarif-max-2')).hide()
                pay(user_id);
            }
            $(this).addClass('was-validated')

            event.preventDefault()
            event.stopPropagation()

        })

    });

</script>
<div class="modal fade main-modal" id="popup-tarif-max-2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="popup__wrp">
                <form id="tarif-max__form" class="popup__content needs-validation" novalidate>
                    <div class="popup__title">Завершите регистрацию</div>
                    <!-- <div class="popup__title text-primary">Уважаемый Иван</div> -->
                    <div class="popup__text">Выберите дату в которую вы желаете заселиться:</div>

                    <div class="mb-3">
                        <input type="date" name="date" placeholder="19.10.2021"
                               class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-auto">
                            <div class="form-check form-check-box mb-2">
                                <input class="form-check-input" type="checkbox" value="" name="date-checkbox-1" id="tarif-max__checkbox-1" checked>
                                <label class="form-check-label fs-14" for="tarif-max__checkbox-1">
                                    Как можно быстрее
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-check-box mb-2">
                                <input class="form-check-input" type="checkbox" value="" name="date-checkbox-2" id="tarif-max__checkbox-2">
                                <label class="form-check-label fs-14" for="tarif-max__checkbox-2">
                                    Сегодня
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-check-box mb-2">
                                <input class="form-check-input" type="checkbox" value="" name="date-checkbox-3" id="tarif-max__checkbox-3">
                                <label class="form-check-label fs-14" for="tarif-max__checkbox-3">
                                    Завтра
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="popup__text">Узнавайте первыми о новых, подходящих вариантах сразу после их размещения в сервисе, проверяйте любой объект на актуальность онлайн, наш робот прозвонит понравившиеся вам объекты, проведёт переговоры и моментально уведомит о результате в итоге сэкономит вам время и деньги.</div>

                    <div class="popup__buttons">
                        <button type="submit" id="popup-tarif-max-2_submit" class="btn btn-primary px-5 mb-3">Выбрать способ оплаты</button>

                        <div class="form-check form-check-box mt-4 tarif-max__terms">
                            <input class="form-check-input" type="checkbox" value="" name="terms" id="tarif-max__terms" required>
                            <div class="invalid-feedback text-primary">
                                <div class="d-flex align-items-center">
                                    <img src="/images/icons/arrow-down-green.svg">Чтобы продолжить пользоваться сервисом, необходимо согласиться с условиями и порядком оплаты услуг
                                </div>
                            </div>
                            <label class="form-check-label text-dark fs-10" for="tarif-max__terms">
                                Подтверждаю, что уведомлен и согласен с условиями и порядком оплаты услуг, а так же обязуюсь оплатить тариф "Найдётся всё" стоимостью 5 791 рублей автоматическим платежом в выбранный день в независимости от факта заселения с банковской карты привязанной к сервису после первой оплаты. Гарантии.
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php global $auth; ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        <?php if(is_null($auth())) { ?>
        $('#tarif-max__form').submit(function (event) {

            if (checkValidate(this)) {
                $.ajax({
                    url: "/join",
                    data: $(this).serialize() + `&object=${object_id}`,
                    method: "POST"
                })
                    .done(function(data) {
                        if (data['result'] === "OK") {
                            user_id = data['user_id'];
                            Modal.getOrCreateInstance($("#popup-tarif-select-date")).hide()
                            pay(user_id, full_amount)
                            // $("#login_suggestion").css({"display": "none"})
                            // $("#auth__back-accordion").css({"display": "none"})
                            // document.querySelector('.auth__steps-reg').swiper.slideNext()
                        } else {
                            swal({
                                title: "Ошибка",
                                text: data['reason'],
                                icon: "error",
                                buttons: ["Поддержка", "ОК"]
                            }).then(data => {if(!data) Chatra('openChat', true);});
                        }
                    })
                    .fail(function(data) {
                        swal({
                            title: "Ошибка",
                            text: data['reason'],
                            icon: "error",
                            buttons: ["Поддержка", "ОК"]
                        }).then(data => {if(!data) Chatra('openChat', true);});
                    })
            }
            event.preventDefault()
            event.stopPropagation()
        })
        <?php } else { ?>
        $('#tarif-max__form').submit(function (event) {
            if (checkValidate(this)) {
                Modal.getOrCreateInstance($("#popup-tarif-select-date")).hide()
                pay(user_id, full_amount)
                event.preventDefault()
                event.stopPropagation()
            }
        })
        <?php } ?>
    })
</script>
<div class="modal fade main-modal" id="popup-tarif-select-date" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
        <div class="modal-content h-auto" >
            <div class="popup__wrp">
                <?php if(is_null($auth())) { ?>
                    <form id="tarif-max__form" class="popup__content needs-validation loading" novalidate>
                        <div class="popup__title">Выберите день в который вам необходимо заселиться</div>
                        <!-- <div class="popup__title text-primary">Уважаемый Иван</div> -->
                        <div class="popup__text">Мы подберём подходящие варианты по цене, местоположению, условиям и дате заезда + закажим выписку в ЕГРН чтобы вы удачно заселились.</div>

                        <p class="fw-500 mt-4 fs-5 text-center fs-4 fw-bold">РЕЗУЛЬТАТ</p>

                        <p class="border border-primary border-3 rounded-3 border-dashed text-center fw-500 p-3">Вы арендуете лучший вариант на самых выгодных условиях в желаемый день и будете довольны!</p>


                        <div class="text-center fw-500 mt-4">Мы настолько уверены в программе заселения Take-Keys VIP, что гарантируем
                            <p class="fs-2 fw-lighter mt-3">100% ВОЗВРАТ СРЕДСТВ</p>
                            Если вы арендуете жильё которого нет в нашей системе, то мы просто вернём ваши деньги без лишних вопросов.</div>

                        <div class="mt-4 mb-3">
                            <input type="date" name="date" placeholder="01.01.2022"
                                   class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-4">
                            <div class="mb-3">
                                <input form="tarif-max__form" type="text" name="name" placeholder="ФИО" class="form-control"
                                       autocomplete required>
                                <div class="invalid-feedback">Пожалуйста, введите ваше имя</div>
                            </div>
                            <div class="mb-3">
                                <input form="tarif-max__form" type="tel" name="phone" placeholder="Телефон"
                                       class="form-control" required data-mask="+{7} (000) 000-00-00"
                                       autocomplete="phone">
                                <div class="invalid-feedback">Пожалуйста, введите корректный номер
                                    телефона</div>
                            </div>
                            <div class="mb-3">
                                <input form="tarif-max__form" type="email" name="email" placeholder="Ваш E-mail" class="form-control"
                                       required>
                                <div class="invalid-feedback">Пожалуйста, введите корректный Email</div>
                            </div>
                            <div class="mb-3">
                                <input form="tarif-max__form" type="password" name="password" placeholder="Пароль" class="form-control"
                                       autocomplete="current-password" required>
                                <div class="invalid-feedback">Пожалуйста, введите пароль</div>
                            </div>
                        </div>

                        <div class="mt-4 popup__buttons">
                            <button type="submit" class="btn btn-primary px-5 mb-1">Выбрать способ оплаты</button>
                            <div class="tarif-take-keys__pay-method mb-3">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple-pay" class="svg-inline--fa fa-apple-pay fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M116.9 158.5c-7.5 8.9-19.5 15.9-31.5 14.9-1.5-12 4.4-24.8 11.3-32.6 7.5-9.1 20.6-15.6 31.3-16.1 1.2 12.4-3.7 24.7-11.1 33.8m10.9 17.2c-17.4-1-32.3 9.9-40.5 9.9-8.4 0-21-9.4-34.8-9.1-17.9.3-34.5 10.4-43.6 26.5-18.8 32.3-4.9 80 13.3 106.3 8.9 13 19.5 27.3 33.5 26.8 13.3-.5 18.5-8.6 34.5-8.6 16.1 0 20.8 8.6 34.8 8.4 14.5-.3 23.6-13 32.5-26 10.1-14.8 14.3-29.1 14.5-29.9-.3-.3-28-10.9-28.3-42.9-.3-26.8 21.9-39.5 22.9-40.3-12.5-18.6-32-20.6-38.8-21.1m100.4-36.2v194.9h30.3v-66.6h41.9c38.3 0 65.1-26.3 65.1-64.3s-26.4-64-64.1-64h-73.2zm30.3 25.5h34.9c26.3 0 41.3 14 41.3 38.6s-15 38.8-41.4 38.8h-34.8V165zm162.2 170.9c19 0 36.6-9.6 44.6-24.9h.6v23.4h28v-97c0-28.1-22.5-46.3-57.1-46.3-32.1 0-55.9 18.4-56.8 43.6h27.3c2.3-12 13.4-19.9 28.6-19.9 18.5 0 28.9 8.6 28.9 24.5v10.8l-37.8 2.3c-35.1 2.1-54.1 16.5-54.1 41.5.1 25.2 19.7 42 47.8 42zm8.2-23.1c-16.1 0-26.4-7.8-26.4-19.6 0-12.3 9.9-19.4 28.8-20.5l33.6-2.1v11c0 18.2-15.5 31.2-36 31.2zm102.5 74.6c29.5 0 43.4-11.3 55.5-45.4L640 193h-30.8l-35.6 115.1h-.6L537.4 193h-31.6L557 334.9l-2.8 8.6c-4.6 14.6-12.1 20.3-25.5 20.3-2.4 0-7-.3-8.9-.5v23.4c1.8.4 9.3.7 11.6.7z"></path></svg>,
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-pay" class="svg-inline--fa fa-google-pay fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M105.72,215v41.25h57.1a49.66,49.66,0,0,1-21.14,32.6c-9.54,6.55-21.72,10.28-36,10.28-27.6,0-50.93-18.91-59.3-44.22a65.61,65.61,0,0,1,0-41l0,0c8.37-25.46,31.7-44.37,59.3-44.37a56.43,56.43,0,0,1,40.51,16.08L176.47,155a101.24,101.24,0,0,0-70.75-27.84,105.55,105.55,0,0,0-94.38,59.11,107.64,107.64,0,0,0,0,96.18v.15a105.41,105.41,0,0,0,94.38,59c28.47,0,52.55-9.53,70-25.91,20-18.61,31.41-46.15,31.41-78.91A133.76,133.76,0,0,0,205.38,215Zm389.41-4c-10.13-9.38-23.93-14.14-41.39-14.14-22.46,0-39.34,8.34-50.5,24.86l20.85,13.26q11.45-17,31.26-17a34.05,34.05,0,0,1,22.75,8.79A28.14,28.14,0,0,1,487.79,248v5.51c-9.1-5.07-20.55-7.75-34.64-7.75-16.44,0-29.65,3.88-39.49,11.77s-14.82,18.31-14.82,31.56a39.74,39.74,0,0,0,13.94,31.27c9.25,8.34,21,12.51,34.79,12.51,16.29,0,29.21-7.3,39-21.89h1v17.72h22.61V250C510.25,233.45,505.26,220.34,495.13,211ZM475.9,300.3a37.32,37.32,0,0,1-26.57,11.16A28.61,28.61,0,0,1,431,305.21a19.41,19.41,0,0,1-7.77-15.63c0-7,3.22-12.81,9.54-17.42s14.53-7,24.07-7C470,265,480.3,268,487.64,273.94,487.64,284.07,483.68,292.85,475.9,300.3Zm-93.65-142A55.71,55.71,0,0,0,341.74,142H279.07V328.74H302.7V253.1h39c16,0,29.5-5.36,40.51-15.93.88-.89,1.76-1.79,2.65-2.68A54.45,54.45,0,0,0,382.25,158.26Zm-16.58,62.23a30.65,30.65,0,0,1-23.34,9.68H302.7V165h39.63a32,32,0,0,1,22.6,9.23A33.18,33.18,0,0,1,365.67,220.49ZM614.31,201,577.77,292.7h-.45L539.9,201H514.21L566,320.55l-29.35,64.32H561L640,201Z"></path></svg>,
                                Банковские карты</div>


                            <div class="form-check form-check-box mt-4 tarif-max__terms">
                                <input class="form-check-input" type="checkbox" value="" name="terms" id="tarif-max__terms" required>
                                <div class="invalid-feedback text-primary">
                                    <div class="d-flex align-items-center">
                                        <img src="/images/icons/arrow-down-green.svg">Чтобы продолжить пользоваться сервисом, необходимо согласиться с условиями и порядком оплаты услуг
                                    </div>
                                </div>
                                <label class="form-check-label text-dark fs-10" for="tarif-max__terms">
                                    Подтверждаю, что уведомлен и согласен с <a href="https://take-keys.online/documents" target="_blank">условиями обслуживания</a> и <a href="https://take-keys.online/documents#!/tab/359162567-4" target="_blank">порядком оплаты услуг</a>. Средства в размере 8891 ₽ спишутся автоматически в выбранный вами день заселения, сервис действует еще месяц после вашего фактического заселения.
                                </label>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <form id="tarif-max__form" class="popup__content needs-validation loading" novalidate>
                        <div class="popup__title">Выберите день в который вам необходимо заселиться</div>
                        <!-- <div class="popup__title text-primary">Уважаемый Иван</div> -->
                        <div class="popup__text">Мы подберём подходящие варианты по цене, местоположению, условиям и дате заезда + закажим выписку в ЕГРН чтобы вы удачно заселились.</div>

                        <p class="fw-500 mt-4 fs-5 text-center fs-4 fw-bold">РЕЗУЛЬТАТ</p>

                        <p class="border border-primary border-3 rounded-3 border-dashed text-center fw-500 p-3">Вы арендуете лучший вариант на самых выгодных условиях в желаемый день и будете довольны!</p>


                        <div class="text-center fw-500 mt-4">Мы настолько уверены в программе заселения Take-Keys VIP, что гарантируем
                            <p class="fs-2 fw-lighter mt-3">100% ВОЗВРАТ СРЕДСТВ</p>
                            Если вы арендуете жильё которого нет в нашей системе, то мы просто вернём ваши деньги без лишних вопросов.</div>

                        <div class="mb-4 mt-4">
                            <input type="date" name="date" placeholder="01.01.2022"
                                   class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mt-4 popup__buttons">
                            <button type="submit" class="btn btn-primary px-5 mb-1">Выбрать способ оплаты</button>
                            <div class="tarif-take-keys__pay-method mb-3">
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple-pay" class="svg-inline--fa fa-apple-pay fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M116.9 158.5c-7.5 8.9-19.5 15.9-31.5 14.9-1.5-12 4.4-24.8 11.3-32.6 7.5-9.1 20.6-15.6 31.3-16.1 1.2 12.4-3.7 24.7-11.1 33.8m10.9 17.2c-17.4-1-32.3 9.9-40.5 9.9-8.4 0-21-9.4-34.8-9.1-17.9.3-34.5 10.4-43.6 26.5-18.8 32.3-4.9 80 13.3 106.3 8.9 13 19.5 27.3 33.5 26.8 13.3-.5 18.5-8.6 34.5-8.6 16.1 0 20.8 8.6 34.8 8.4 14.5-.3 23.6-13 32.5-26 10.1-14.8 14.3-29.1 14.5-29.9-.3-.3-28-10.9-28.3-42.9-.3-26.8 21.9-39.5 22.9-40.3-12.5-18.6-32-20.6-38.8-21.1m100.4-36.2v194.9h30.3v-66.6h41.9c38.3 0 65.1-26.3 65.1-64.3s-26.4-64-64.1-64h-73.2zm30.3 25.5h34.9c26.3 0 41.3 14 41.3 38.6s-15 38.8-41.4 38.8h-34.8V165zm162.2 170.9c19 0 36.6-9.6 44.6-24.9h.6v23.4h28v-97c0-28.1-22.5-46.3-57.1-46.3-32.1 0-55.9 18.4-56.8 43.6h27.3c2.3-12 13.4-19.9 28.6-19.9 18.5 0 28.9 8.6 28.9 24.5v10.8l-37.8 2.3c-35.1 2.1-54.1 16.5-54.1 41.5.1 25.2 19.7 42 47.8 42zm8.2-23.1c-16.1 0-26.4-7.8-26.4-19.6 0-12.3 9.9-19.4 28.8-20.5l33.6-2.1v11c0 18.2-15.5 31.2-36 31.2zm102.5 74.6c29.5 0 43.4-11.3 55.5-45.4L640 193h-30.8l-35.6 115.1h-.6L537.4 193h-31.6L557 334.9l-2.8 8.6c-4.6 14.6-12.1 20.3-25.5 20.3-2.4 0-7-.3-8.9-.5v23.4c1.8.4 9.3.7 11.6.7z"></path></svg>,
                                <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-pay" class="svg-inline--fa fa-google-pay fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M105.72,215v41.25h57.1a49.66,49.66,0,0,1-21.14,32.6c-9.54,6.55-21.72,10.28-36,10.28-27.6,0-50.93-18.91-59.3-44.22a65.61,65.61,0,0,1,0-41l0,0c8.37-25.46,31.7-44.37,59.3-44.37a56.43,56.43,0,0,1,40.51,16.08L176.47,155a101.24,101.24,0,0,0-70.75-27.84,105.55,105.55,0,0,0-94.38,59.11,107.64,107.64,0,0,0,0,96.18v.15a105.41,105.41,0,0,0,94.38,59c28.47,0,52.55-9.53,70-25.91,20-18.61,31.41-46.15,31.41-78.91A133.76,133.76,0,0,0,205.38,215Zm389.41-4c-10.13-9.38-23.93-14.14-41.39-14.14-22.46,0-39.34,8.34-50.5,24.86l20.85,13.26q11.45-17,31.26-17a34.05,34.05,0,0,1,22.75,8.79A28.14,28.14,0,0,1,487.79,248v5.51c-9.1-5.07-20.55-7.75-34.64-7.75-16.44,0-29.65,3.88-39.49,11.77s-14.82,18.31-14.82,31.56a39.74,39.74,0,0,0,13.94,31.27c9.25,8.34,21,12.51,34.79,12.51,16.29,0,29.21-7.3,39-21.89h1v17.72h22.61V250C510.25,233.45,505.26,220.34,495.13,211ZM475.9,300.3a37.32,37.32,0,0,1-26.57,11.16A28.61,28.61,0,0,1,431,305.21a19.41,19.41,0,0,1-7.77-15.63c0-7,3.22-12.81,9.54-17.42s14.53-7,24.07-7C470,265,480.3,268,487.64,273.94,487.64,284.07,483.68,292.85,475.9,300.3Zm-93.65-142A55.71,55.71,0,0,0,341.74,142H279.07V328.74H302.7V253.1h39c16,0,29.5-5.36,40.51-15.93.88-.89,1.76-1.79,2.65-2.68A54.45,54.45,0,0,0,382.25,158.26Zm-16.58,62.23a30.65,30.65,0,0,1-23.34,9.68H302.7V165h39.63a32,32,0,0,1,22.6,9.23A33.18,33.18,0,0,1,365.67,220.49ZM614.31,201,577.77,292.7h-.45L539.9,201H514.21L566,320.55l-29.35,64.32H561L640,201Z"></path></svg>,
                                Банковские карты</div>

                            <div class="form-check form-check-box mt-4 tarif-max__terms">
                                <input class="form-check-input" type="checkbox" value="" name="terms" id="tarif-max__terms" required>
                                <div class="invalid-feedback text-primary">
                                    <div class="d-flex align-items-center">
                                        <img src="/images/icons/arrow-down-green.svg">Чтобы продолжить пользоваться сервисом, необходимо согласиться с условиями и порядком оплаты услуг
                                    </div>
                                </div>
                                <label class="form-check-label text-dark fs-10" for="tarif-max__terms">
                                    Подтверждаю, что уведомлен и согласен с <a href="https://take-keys.online/documents" target="_blank">условиями обслуживания</a> и <a href="https://take-keys.online/documents#!/tab/359162567-4" target="_blank">порядком оплаты услуг</a>. Средства в размере 8891 ₽ спишутся автоматически в выбранный вами день заселения, сервис действует еще месяц после вашего фактического заселения.
                                </label>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
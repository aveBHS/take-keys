<?php
/**
 * @var bool $forceReg
 */
if (!isset($forceReg))
    $forceReg = false;
?>

<script>
    let user_mail_domain = undefined;

    document.addEventListener('DOMContentLoaded', () => {
        $('[data-bs-target="#auth__modal"]').click()

        $('.auth__form-reg').submit(function (event) {
            if (checkValidate(this)) {
                document.querySelector('.auth__steps-reg').swiper.slideNext()
            }
            event.preventDefault()
            event.stopPropagation()
        })

        $('#auth__send-reg').submit(function (event) {

            let loader = $('.auth.loading')

            if (checkValidate(this)) {
                loader.addClass('active')
                user_mail_domain = this.email.value.split("@")[1];
                $.ajax({
                    url: "/join",
                    data: $(this).serialize() + `&object=${object_id}`,
                    method: "POST"
                })
                    .done(function(data) {
                        if (data['result'] === "OK") {
                            $("#login_suggestion").css({"display": "none"})
                            $("#auth__back-accordion").css({"display": "none"})
                            document.querySelector('.auth__steps-reg').swiper.slideNext()
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
                    .always(function() {
                        loader.removeClass('active')
                    });
            }
            event.preventDefault()
            event.stopPropagation()
        })

        $('#open-email').submit(function (event) {
           window.location = `https://${user_mail_domain ?? gmail.com}/`;
            event.preventDefault()
            event.stopPropagation()
        });
    })


    function skipEmailValidation(){
        window.location.reload();
    }

</script>

<div class="modal fade main-modal" id="popup-auth" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="row g-0 h-100 flex-lg-nowrap">
                <div class="col-12 col-lg">
                    <div class="auth__img"
                         style="background-image: url('/images/dist/registration.jpg'); background-position: 0 90%;">
                        <div class="accordion" id="auth__back-accordion">
                            <div class="auth__reg collapse" data-bs-parent="#auth__back-accordion">
                                <div class="auth__back auth__back-reg">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M5.53033 9.53033C5.23744 9.82322 4.76256 9.82322 4.46967 9.53033L0.46967 5.53033C0.329018 5.38968 0.25 5.19891 0.25 5C0.25 4.80109 0.329018 4.61032 0.46967 4.46967L4.46967 0.46967C4.76256 0.176777 5.23744 0.176777 5.53033 0.46967C5.82322 0.762563 5.82322 1.23744 5.53033 1.53033L2.06066 5L5.53033 8.46967C5.82322 8.76256 5.82322 9.23744 5.53033 9.53033Z"
                                              fill="white" />
                                    </svg>
                                </div>
                            </div>
                            <div class="auth__reg collapse show" data-bs-parent="#reg__back-accordion">
                                <div class="auth__back auth__back-reg">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M5.53033 9.53033C5.23744 9.82322 4.76256 9.82322 4.46967 9.53033L0.46967 5.53033C0.329018 5.38968 0.25 5.19891 0.25 5C0.25 4.80109 0.329018 4.61032 0.46967 4.46967L4.46967 0.46967C4.76256 0.176777 5.23744 0.176777 5.53033 0.46967C5.82322 0.762563 5.82322 1.23744 5.53033 1.53033L2.06066 5L5.53033 8.46967C5.82322 8.76256 5.82322 9.23744 5.53033 9.53033Z"
                                              fill="white" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto">

                    <div class="accordion auth loading h-100" id="auth-accordion">
                        <div class="auth__reg h-100 collapse <?=$forceReg?'show':''?>" data-bs-parent="#auth-accordion">
                            <div class="auth__text h-100">
                                <div class="auth__steps-wrp flex-grow-1">
                                    <div class="swiper auth__steps-reg">
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            <div class="swiper-slide">
                                                <div class="auth__form-reg" data-swiper-parallax="100%">
                                                    <div class="auth__title">Мы знаем, как сложно найти подходящий вариант в интернете, поэтому, чтобы вы заселились легко - мы создали систему недвижимости Take-Keys</div>
                                                    <div class="auth__desc" style="font-size: 12px;">
                                                        Это инструмент для поиска подходящего жилья в сжатые сроки.<br>
                                                        Система 24/7 мониторит все сайты недвижимости, доски объявлений и привлекает собственников через рекламные кампании в Яндекс, Google, YouTube и социальные сети, что позволяет, первыми узнавать о новых подходящих вариантах и моментально связываться с владельцами.</div>
                                                </div>
                                                <div class="" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form class="auth__form-reg" novalidate>
                                                        <div class="mb-3">
                                                            <label class="form-label">Как вас представить владельцу?</label>
                                                            <input form="auth__send-reg" type="text" name="name" placeholder="Имя" class="form-control"
                                                                   autocomplete required>
                                                            <div class="invalid-feedback">Пожалуйста, введите ваше имя</div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col">Шаг 1/2</div>
                                                            <div class="col-auto">
                                                                <button class="btn btn-primary auth__btn" type="submit">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="svg-wrp me-3">
                                                                            <svg width="6" height="10" viewBox="0 0 6 10"
                                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                      d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"
                                                                                      fill="#A3CC4A" />
                                                                            </svg>
                                                                        </i>
                                                                        Продолжить
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="auth__terms form-check form-check-box mt-3">
                                                            <input class="form-check-input" type="checkbox" name="terms" id="auth__terms-reg" required>
                                                            <label class="form-check-label" for="auth__terms-reg">
                                                                Подтверждаю, что я не являюсь агентом
                                                            </label>
                                                            <div class="invalid-feedback">Пожалуйста, заполните все обязательные поля</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="" data-swiper-parallax="100%">
                                                    <div class="auth__title">Укажите контакты для связи</div>
                                                    <div class="auth__desc" style="font-size: 12px;">Подтвердите почту, чтобы первыми получать уведомления о новых, подходящих вариантах и моментально связываться с владельцами.</div>
                                                </div>
                                                <div class="" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form id="auth__send-reg" class="" novalidate>
                                                        <div class="mb-3">
                                                            <div class="mb-3">
                                                                <input form="auth__send-reg" type="tel" name="phone" placeholder="Телефон"
                                                                       class="form-control" required data-mask="+{7} (000) 000-00-00"
                                                                       autocomplete="phone">
                                                                <div class="invalid-feedback">Пожалуйста, введите корректный номер
                                                                    телефона</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <input form="auth__send-reg" type="email" name="email" placeholder="Ваш E-mail" class="form-control"
                                                                       required>
                                                                <div class="invalid-feedback">Пожалуйста, введите корректный Email</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <input form="auth__send-reg" type="password" name="password" placeholder="Пароль" class="form-control"
                                                                       autocomplete="current-password" required>
                                                                <div class="invalid-feedback">Пожалуйста, введите пароль</div>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="col">Шаг 2/2</div>
                                                            <div class="col-auto">
                                                                <button class="btn btn-dark auth__btn" type="submit">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="svg-wrp me-3">
                                                                            <svg width="6" height="10" viewBox="0 0 6 10"
                                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                      d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"
                                                                                      fill="#151A40" />
                                                                            </svg>
                                                                        </i>
                                                                        Создать аккаунт
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="auth__terms form-check form-check-box mt-3">
                                                            <input class="form-check-input" type="checkbox" name="terms" id="auth__terms-reg" required>
                                                            <label class="form-check-label" for="auth__terms-reg">
                                                                Нажимая на кнопку Создать вы подтверждаете согласие с <a href="https://take-keys.com/documents#!/tab/359162567-1">условиями использования</a> Take-Keys и <a href="https://take-keys.com/documents#!/tab/359162567-2">политикой о данных пользователей</a>
                                                            </label>
                                                            <div class="invalid-feedback">Пожалуйста, заполните все обязательные поля</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="" data-swiper-parallax="100%">
                                                    <div class="auth__title">Чтобы своевременно видеть важные уведомления - подтвердите сейчас почту</div>
                                                    <div class="auth__desc" style="font-size: 12px;">Если вы не получили письмо, проверьте папки «Спам» и «Удаленные», так как письмо могло автоматически туда перейти</div>
                                                </div>
                                                <div class="mt-5" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form id="open-email" novalidate>
                                                        <div class="row align-items-center m-auto">
                                                            <div class="col-auto w-100">
                                                                <button class="btn btn-primary auth__btn w-100" type="submit">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="svg-wrp me-3">
                                                                            <svg width="6" height="10" viewBox="0 0 6 10"
                                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                      d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"
                                                                                      fill="#151A40" />
                                                                            </svg>
                                                                        </i>
                                                                        Открыть почту
                                                                    </div>
                                                                </button>
                                                            </div>
                                                            <div class="col-auto w-100">
                                                            <button class="btn btn-secondary auth__btn w-100 mt-2" type="button" onclick="skipEmailValidation()">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="svg-wrp me-3">
                                                                        <svg width="6" height="10" viewBox="0 0 6 10"
                                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                  d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"
                                                                                  fill="#151A40" />
                                                                        </svg>
                                                                    </i>
                                                                    Пропустить
                                                                </div>
                                                            </button>
                                                        </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--div class="auth__switch" id="login_suggestion">
                                    У вас есть аккаунт?
                                    <a class="ms-3 link text-primary" href="/login">Войти</a>
                                </div-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
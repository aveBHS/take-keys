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
                            window.location.reload();
                            Modal.getOrCreateInstance($("#popup-auth")).hide()
                            Modal.getOrCreateInstance($("#popup-msg-1")).show()
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

        $('#contact-popup-form').submit(function (event) {
            event.preventDefault()
            event.stopPropagation()
            if (checkValidate(this)) {
                Modal.getOrCreateInstance($("#contact-popup-first")).hide()
                Modal.getOrCreateInstance($("#popup-owner-questions")).show()
            }
        });
    })


    function skipEmailValidation(){
        window.location.reload();
    }
    function showRecommendations(){
        window.location = "/catalog/recommendations";
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
                                                <div class="" data-swiper-parallax="100%">
                                                    <div class="auth__title">Укажите контакты</div>
                                                    <div class="auth__desc" style="font-size: 12px;">Как вас представить собственникам?</div>
                                                </div>
                                                <div class="" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form id="auth__send-reg" class="" novalidate>
                                                        <div class="mb-3">
                                                            <div class="mb-3">
                                                                <input form="auth__send-reg" type="text" name="name" placeholder="ФИО" class="form-control"
                                                                       autocomplete required>
                                                                <div class="invalid-feedback">Пожалуйста, введите ваше имя</div>
                                                            </div>
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
                                                                        Создать анкету
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="auth__terms form-check form-check-box mt-3">
                                                            <input class="form-check-input" type="checkbox" name="terms" id="auth__terms-reg" required>
                                                            <label class="form-check-label" for="auth__terms-reg">
                                                                Нажимая на кнопку Создать вы подтверждаете согласие с <a href="https://take-keys.online/documents#!/tab/359162567-1">условиями использования</a> Take-Keys и <a href="https://take-keys.online/documents#!/tab/359162567-2">политикой о данных пользователей</a>
                                                            </label>
                                                            <div class="invalid-feedback">Пожалуйста, заполните все обязательные поля</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
<!--                                            <div class="swiper-slide">-->
<!--                                                <div class="" data-swiper-parallax="100%">-->
<!--                                                    <div class="auth__title">Чтобы своевременно видеть важные уведомления - подтвердите сейчас почту</div>-->
<!--                                                    <div class="auth__desc" style="font-size: 12px;">Если вы не получили письмо, проверьте папки «Спам» и «Удаленные», так как письмо могло автоматически туда перейти</div>-->
<!--                                                </div>-->
<!--                                                <div class="mt-5" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">-->
<!--                                                    <form id="open-email" novalidate>-->
<!--                                                        <div class="row align-items-center m-auto">-->
<!--                                                            <div class="col-auto w-100">-->
<!--                                                                <button class="btn btn-primary auth__btn w-100" type="submit">-->
<!--                                                                    <div class="d-flex align-items-center">-->
<!--                                                                        <i class="svg-wrp me-3">-->
<!--                                                                            <svg width="6" height="10" viewBox="0 0 6 10"-->
<!--                                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                                                                <path fill-rule="evenodd" clip-rule="evenodd"-->
<!--                                                                                      d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"-->
<!--                                                                                      fill="#151A40" />-->
<!--                                                                            </svg>-->
<!--                                                                        </i>-->
<!--                                                                        Открыть почту-->
<!--                                                                    </div>-->
<!--                                                                </button>-->
<!--                                                            </div>-->
<!--                                                            <div class="col-auto w-100">-->
<!--                                                            <button class="btn btn-secondary auth__btn w-100 mt-2" type="button" onclick="skipEmailValidation()">-->
<!--                                                                <div class="d-flex align-items-center">-->
<!--                                                                    <i class="svg-wrp me-3">-->
<!--                                                                        <svg width="6" height="10" viewBox="0 0 6 10"-->
<!--                                                                             fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                                                            <path fill-rule="evenodd" clip-rule="evenodd"-->
<!--                                                                                  d="M0.46967 0.46967C0.762563 0.176777 1.23744 0.176777 1.53033 0.46967L5.53033 4.46967C5.67098 4.61032 5.75 4.80109 5.75 5C5.75 5.19891 5.67098 5.38968 5.53033 5.53033L1.53033 9.53033C1.23744 9.82322 0.762562 9.82322 0.469669 9.53033C0.176776 9.23744 0.176776 8.76256 0.469669 8.46967L3.93934 5L0.46967 1.53033C0.176777 1.23744 0.176777 0.762563 0.46967 0.46967Z"-->
<!--                                                                                  fill="#151A40" />-->
<!--                                                                        </svg>-->
<!--                                                                    </i>-->
<!--                                                                    Пропустить-->
<!--                                                                </div>-->
<!--                                                            </button>-->
<!--                                                        </div>-->
<!--                                                        </div>-->
<!--                                                    </form>-->
<!--                                                </div>-->
<!--                                            </div>-->
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

<div class="modal fade main-modal" id="contact-popup-first" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content h-auto">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp">
                <div class="popup__content align-items-center">

                    <img class="img-fluid mt-3 popup-msg-1__img" src="/images/dist/popup-bg/contact-popup-bg.jpg">
                    <div class="popup__title mt-4 text-center">Для связи с владельцем подтвердите, что вы не агент</div>
                    <div class="popup__text mt-4 text-center popup-msg-1__text">
                        Мы проверим, если вас нет в чёрном списке - сможете продолжить пользоваться сервисом
                    </div>
                    <form class="contact-popup-form" id="contact-popup-form" novalidate>
                        <div class="popup__buttons">
                            <button class="btn btn-primary px-3 w-100">Продолжить</button>
                        </div>
                        <div class="auth__terms form-check form-check-box mt-3">
                            <input class="form-check-input" type="checkbox" name="terms" id="im-natural-client" required>
                            <label class="form-check-label" for="im-natural-client">
                                Подтверждаю что не являюсь агентом или сотрудником агентства недвижимости
                            </label>
                            <div class="invalid-feedback">Пожалуйста, заполните все обязательные поля</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
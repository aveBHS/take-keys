<?php
/**
 * @var bool $forceReg
 */
if (!isset($forceReg))
    $forceReg = false;
?>

<script>
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
                $.ajax({
                    url: "/join",
                    data: $(this).serialize() + `&object=${object_id}`,
                    method: "POST"
                })
                    .done(function(data) {
                        if (data['result'] === "OK") {
                            user_id = data['user_id'];
                            Modal.getOrCreateInstance($('#popup-auth')).hide()
                            Modal.getOrCreateInstance($('#popup-tarif-max-1')).show()
                        } else {
                            swal("Ошибка", data['reason'], "error");
                        }
                    })
                    .fail(function(data) {
                        swal("Ошибка", data['reason'], "error");
                    })
                    .always(function() {
                        loader.removeClass('active')
                    });
            }
            event.preventDefault()
            event.stopPropagation()
        })

    })

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
                                                    <div class="auth__title">Для продолжения пользования сервисом, создайте аккаунт</div>
                                                    <div class="auth__desc">Take Keys объединяет объявления о недвижимости самых популярных площадок Рунета, чтобы сделать подбор жилья максимально удобным для Вас</div>
                                                </div>
                                                <div class="" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form class="auth__form-reg" novalidate>
                                                        <div class="mb-3">
                                                            <input form="auth__send-reg" type="email" name="email" placeholder="Ваш E-mail" class="form-control"
                                                                   required>
                                                            <div class="invalid-feedback">Пожалуйста, введите корректный Email
                                                            </div>
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
                                                    </form>
                                                    <!--div class="auth__soc">
                                                        <div class="auth__soc__title mb-3"><span>Продолжить используя:</span></div>
                                                        <div class="row row-cols-2 gx-3 gy-2">
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-vk.svg">Вконтакте</button>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-fb.svg">Facebook</button>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-ya.svg">Яндекс</button>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-apple.svg">Apple</button>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-mail.svg">Mail.ru</button>
                                                            </div>
                                                            <div class="col">
                                                                <button class="btn auth__soc__btn"><img src="/images/icons/soc-google.svg">Google</button>
                                                            </div>
                                                        </div>
                                                    </div-->
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="" data-swiper-parallax="100%">
                                                    <div class="auth__title">Для продолжения пользования сервисом, создайте аккаунт</div>
                                                    <div class="auth__desc">Take Keys объединяет объявления о недвижимости самых популярных площадок Рунета, чтобы сделать подбор жилья максимально удобным для Вас</div>
                                                </div>
                                                <div class="" data-swiper-parallax="30%" data-swiper-parallax-opacity="0">
                                                    <form id="auth__send-reg" class="" novalidate>
                                                        <div class="mb-3">
                                                            <label class="form-label">Как вас представить заказчику?</label>
                                                            <input form="auth__send-reg" type="text" name="name" placeholder="ФИО" class="form-control"
                                                                   autocomplete required>
                                                            <div class="invalid-feedback">Пожалуйста, введите пароль</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <input form="auth__send-reg" type="tel" name="phone" placeholder="Телефон"
                                                                   class="form-control" required data-mask="+{7} (000) 000-00-00"
                                                                   autocomplete="phone">
                                                            <div class="invalid-feedback">Пожалуйста, введите корректный номер
                                                                телефона</div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <input form="auth__send-reg" type="password" name="password" placeholder="Пароль" class="form-control"
                                                                   autocomplete="current-password" required>
                                                            <div class="invalid-feedback">Пожалуйста, введите пароль</div>
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
                                                                        Создать
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="auth__terms form-check form-check-box mt-3">
                                                            <input class="form-check-input" type="checkbox" value="" name="terms" id="auth__terms-reg" checked required>
                                                            <label class="form-check-label" for="auth__terms-reg">
                                                                Нажимая на кнопку Создать вы подтверждаете согласие с <a href="#">условиями использования</a> Take-Keys и <a href="#">политикой</a> о <a href="#">данных пользователей</a>
                                                            </label>
                                                            <div class="invalid-feedback">Это обязательное поле</div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="auth__switch">
                                    У вас есть аккаунт?
                                    <a class="ms-3 link text-primary" href="/login">Войти</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
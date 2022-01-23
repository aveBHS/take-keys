<script>
    function sendNotifySettings() {
        let form = $('#notify-methods-form')
        $.post({
            type: 'POST',
            url: '/api/user/notifies/',
            data: form.serialize(),
        }).done(function (data) {
            Modal.getOrCreateInstance($('#popup-notification')).hide()
            Modal.getOrCreateInstance($('#popup-auth')).show()
        });
    }
</script>

<div class="modal fade main-modal" id="popup-notification" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp" style="background: url('/images/dist/popup-bg/notification.svg') no-repeat right 0 bottom 24px">
                <div class="popup__content">
                    <div class="accordion" id="notif-switch">
                        <div class="notif-on" data-parent="#notif-switch">
                            <div class="popup__title">Анкета успешно создана</div>
                            <p class="popup__text">
                                Выберите, где вас уведомить о результате?
                            </p>
                        </div>
                    </div>
                    <form id="notify-methods-form">
                        <div class="popup__checkboxies">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notif-whatsapp" name="whatsapp-channel" checked="">
                                <label class="form-check-label" for="notif-whatsapp">
                                    <img src="/images/icons/notif-whatsapp.svg" alt="">
                                    WhatsApp
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notif-telegram" name="telegram-channel">
                                <label class="form-check-label" for="notif-telegram">
                                    <img src="/images/icons/notif-telegram.svg" alt="">
                                    Telegram
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notif-viber" name="viber-channel">
                                <label class="form-check-label" for="notif-viber">
                                    <img src="/images/icons/notif-viber.svg" alt="">
                                    Viber
                                </label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="notif-email" name="email-channel">
                                <label class="form-check-label" for="notif-email">
                                    <img src="/images/icons/notif-email.svg" alt="">
                                    E-mail
                                </label>
                            </div>
                        </div>
                    </form>
                    <div class="popup__buttons position-relative" type="button" onclick="sendNotifySettings()">
                        <button class="btn btn-primary px-4 px-lg-5 popup-owner-questions__next">Дальше</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
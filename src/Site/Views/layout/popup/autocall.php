<script>
    function send_call_request() {
        $.ajax({
            url: "/api/objects/call",
            data: `object=${object_id}`,
            method: "POST"
        })
        .done(function(data) {
            if (data['result'] === "OK") {
                Modal.getOrCreateInstance($('#popup-autocall')).show()
            } else if (data['result'] === "INFO") {
                swal({
                    title: "Уведомление",
                    text: data['reason'],
                    icon: "info",
                    buttons: ["Закрыть", "Мои заявки"]
                }).then(data => {if(data) window.location="/notifies/";});
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
            swal("Ошибка", "Повторите попытку позже", "error");
        })
    }

</script>
<div class="modal fade main-modal" id="popup-autocall" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content h-auto">
            <div class="popup__wrp">
                <div class="popup__content align-items-center">

                    <img class="img-fluid mt-3 popup-msg-1__img" src="/images/dist/popup-bg/call_request_sent.png">
                    <div class="popup__title">Ваш запрос принят и мы уже его обрабатываем</div>
                    <div class="popup__text mt-4 text-center popup-msg-1__text">
                        Обычно связь с владельцами устанавливается за 5-30 минут, но иногда нужно больше времени. Пожалуйста ожидайте, как только мы получим информацию - моментально вас уведомим.
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
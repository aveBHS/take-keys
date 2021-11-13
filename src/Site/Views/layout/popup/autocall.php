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
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp" style="background: url('/images/dist/popup-bg/robot.svg') no-repeat right 24px bottom 24px">
                <div class="popup__content">
                    <div class="popup__title">Больше не нужно тратить время и деньги на прозвон объявлений.</div>
                    <div class="popup__text text-center">Мы создали умный алгоритм автоматического дозвона до авторов объявлений.</div>
                    <div class="popup__title">Как это работает?</div>
                    <div class="popup__text">
                        <p>В понравившемся объекте кликните кнопку "связаться" и наш робот моментально позвонит владельцу, отсеит посредников и уведомит вас по смс о результате звонка, а если автор объявления не возьмет трубку, то робот перезвонит через время еще раз и снова уведомит вас о результате.</p>
                    </div>
                    <div class="popup__buttons">
                        <a href="/catalog/recommendations" class="btn btn-primary">Смотреть другие варианты</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
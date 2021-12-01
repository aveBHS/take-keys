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
        <div class="modal-content" style="height: auto !important;">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="popup__wrp" style="background: url('/images/dist/popup-bg/robot.svg') no-repeat right 24px bottom 24px">
                <div class="popup__content">
                    <div class="popup__title"><?php global $auth; echo $auth()->name ?? "Уважаемый пользователь"?>, для вашего удобства и безопасности мы берём первичные переговоры с авторами объявлений на себя.</div>
                    <div class="popup__text text-center">Операторы уже получили заявку, обычно прозвон 1 объекта занимает 2 минуты, но иногда может потребоваться больше времени. Мы за свой счёт связываемся с авторами объявлений и информируем вас о результате каждого звонка, а если не дозвонимся с первого раза, то перезвоним ещё раз.
                        Уведомление о результате звонка вы получите на почту, пожалуйста ожидайте.</div>
                    <div class="popup__title">Зачем это необходимо?</div>
                    <div class="popup__text">
                        <p>Если вы не в первый раз ищите жильё, то уже знаете, что при попытке звонка можно связаться с собственником и договориться о встрече, но чаще всего не удаётся с первого раза дозвониться в силу разных, индивидуальных ситуаций. Объект может быть уже не актуален или автор объявления занят на работе, отдыхе, укладывают детей спать, за рулём, едет в лифте без сети, могут банально не ответить по многим другим причинам. Но основная причина по которой мы берём переговоры на себя, это недобросовестные участники рынка недвижимости, к сожалению многие посредники работают не честно, публикуют фэйковые, не реальные варианты в корыстных целях. По статистике, каждый второй пользователь при самостоятельных поисках попадал в нежелательные ситуации, подвергаясь введению в заблуждение тратив время, деньги и хорошее настроение. По этому мы принимаем ответственность за наших пользователей и поддерживаем вас на каждом этапе. </p>
                    </div>
                    <div class="popup__buttons" style="margin-top: auto">
                        <a href="/catalog/recommendations" class="btn btn-primary">Показать <?=count(explode(",", $auth()->request->recommendations))?> объявлений</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
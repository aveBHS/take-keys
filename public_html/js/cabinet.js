function cancel_request(request_id){
    swal({
        icon: "warning",
        title: "Отменить заявку",
        text: "Вы действительно хотите отменить заявку связи с владельцем?",
        buttons: ["Нет", "Отменить"],
        dangerMode: true,
    }).then(result => {
        if(result) {
            $.ajax({
                url: `/api/objects/cancel_call/${request_id}/`,
                method: "POST"
            })
            .done(function (data) {
                if (data['result'] === "OK") {
                    window.location.reload();
                } else {
                    swal({
                        title: "Ошибка",
                        text: data['reason'],
                        icon: "error",
                        buttons: ["Поддержка", "ОК"]
                    }).then(data => {
                        if (!data) Chatra('openChat', true);
                    });
                }
            })
            .fail(function (data) {
                swal("Ошибка", "Повторите попытку позже", "error");
            })
        }
    })
}
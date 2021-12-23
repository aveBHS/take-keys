function setCatalogView(mode){
    $.post(
        "/api/settings/catalog_view_mode",
        {"param": mode},
        () => (window.location.reload())
    );
}

function setFavorite(event){
    let object_id = +event.attributes['data-object-id'].value;
    if(object_id > 0) {
        $.post(
            `/api/objects/favorite/${object_id}`,
            (data) => {
                if(data['result'] === "ADDED"){
                    event.getElementsByTagName("img")[0]['src'] = "/images/icons/heart_checked.svg";
                } else if(data['result'] === "REMOVED"){
                    event.getElementsByTagName("img")[0]['src'] = "/images/icons/heart.svg";
                } else if(data['result'] === "NOT_FOUND") {
                    swal("Не найдено", "Запрашиваемый объект не найден в базе", "info");
                } else if(data['result'] === "NOT_ALLOWED") {
                    swal({
                        title: "Ограничение",
                        text: "Функция добавления в избранное доступна только для зарегистрированных пользователей",
                        icon: "info",
                        buttons: ["Закрыть", "Войти"]
                    }).then(result => {
                        if(result) window.location = "/login";
                    });
                } else {
                    swal("Ошибка", "Произошла неизвестная ошибка, обновите страницу и повторите попытку", "error");
                }
            }
        );
    }
}

function getPhone(request_id){
    $.get(`/api/objects/call_result/${request_id}`).then(response => {
        if(response['result'] === "ok"){
            let phone = ("+" + response['phone']).split('');
            if(phone.length){
                phone.splice(2,0, " (");
                phone.splice(6,0, ") ");
                phone.splice(10,0, "-");
                phone.splice(13,0, "-");
            }else if(phone.length){
                phone.splice(3,0, " (");
                phone.splice(7,0, ") ");
                phone.splice(11,0, "-");
                phone.splice(14,0, "-");
            }
            swal({
                title: phone.join(''),
                text: "Свяжитесь с собственником по этому номеру",
                buttons: ["Поддержка", "Закрыть"]
            }).then(data => {if(!data) Chatra('openChat', true);});
        } else {
            swal({
                title: "Ошибка",
                text: response['reason'],
                icon: "error",
                buttons: ["Поддержка", "ОК"]
            }).then(data => {if(!data) Chatra('openChat', true);});
        }
    })
}
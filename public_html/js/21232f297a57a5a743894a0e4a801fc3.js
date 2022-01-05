function publishObject(object_id){
    swal({
        title: "Подтверждение",
        text: "Вы действительно хотите опубликовать этот объект в основном каталоге?",
        buttons: ["Отменить", "Продолжить"],
        icon: "warning",
        dangerMode: true
    }).then(result => {
        if(result){
            swal({
                title: "Запущен перенос объекта",
                text: "Пожалуйста, не закрывайте окно до завершения процесса",
                buttons: false,
                icon: "info"
            })
            $.post({
                url: `/panel/objects/catalog_sell/public/${object_id}`
            }).then(result => {
                console.log(result);
                if(result['result'].toLowerCase() === "ok"){
                    swal({
                        title: "Успешно",
                        text: `Объект опубликован под ID${result['object_id']}`,
                        buttons: ["В каталог", "Открыть объект"],
                        icon: "success",
                    }).then(open_object => {
                        if(open_object){
                            window.location = `/id/${result['object_id']}`;
                        } else {
                            window.location = `/panel/objects/catalog_sell/`;
                        }
                    })
                }
            })
        }
    })
}

function removePhoto(target, photo_id){
    swal({
        title: "Подтверждение",
        text: "Вы действительно хотите удалить это фото? Эта операция необратима",
        buttons: ["Отменить", "Удалить"],
        icon: "warning",
        dangerMode: true
    }).then(result => {
        if(result){
            target.parentElement.remove();
            $.post({
                url: `/panel/objects/remove_pic/${photo_id}`
            })
        }
    })
}

function editObject(object_id){
    window.location = `/panel/objects/edit/-${object_id}`;
}
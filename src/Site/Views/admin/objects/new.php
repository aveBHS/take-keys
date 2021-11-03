<?php
/**
 * @var array $object_types
 */
?>
<?=view("admin.layout.header", ["title" => "Создание объекта"])?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Опубликовать объект</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Управление объектами Take-Keys</li>
    </ol>

    <form method="post" enctype="multipart/form-data">
        <h3>Основная информация</h3><hr>
        <div class="mb-3">
            <label for="object_title" class="form-label">Заголовок объекта</label>
            <input type="text" class="form-control" id="object_title" name="object_title" placeholder="Комната 30 м² в 3-к., 5/15 эт." required>
        </div>
        <div class="mb-3">
            <label for="object_cost" class="form-label">Стоимость</label>
            <input type="number" class="form-control" id="object_cost" name="object_cost" required min="1000" placeholder="30 000">
        </div>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_type">Тип объекта</label>
            <select class="form-control" id="object_type" name="object_type" required>
                <?php foreach($object_types as $object_type){
                   echo("<option value='{$object_type->inpars_id}'>{$object_type->object_type_slug}</option>");
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_ad">Тип предложения</label>
            <select class="form-control" id="object_ad" name="object_ad" required>
                <option value="1" selected>Сдам</option>
                <option value="2">Продам</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_region">Регион объекта</label>
            <select class="form-control" id="object_region" name="object_region" required>
                <option value="77" selected>Москва</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_city">Город объекта</label>
            <select class="form-control" id="object_city" name="object_city" required>
                <option value="1" selected>Москва</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="object_desc" class="form-label">Описание объекта</label>
                <textarea class="form-control" id="object_desc" rows="3" name="object_desc" required></textarea>
        </div>

        <div class="mb-3">
            <label for="object_address" class="form-label">Адрес объекта</label>
            <input type="text" class="form-control" id="object_address" name="object_address" placeholder="Москва, ул. Маросейка, 10/1с3 " required>
        </div>
        <div class="form-row" style="display: flex">
            <div class="form-group col-md-6">
                <label for="object_lat" class="form-label">Широта</label>
                <input type="number" class="form-control" id="object_lat" name="object_lat" placeholder="55.558741" step="0.0000000001" required>
            </div>
            <div class="form-group col-md-6">
                <label for="object_lng" class="form-label">Долгота</label>
                <input type="number" class="form-control" id="object_lng" name="object_lng" placeholder="37.378847" step="0.0000000001" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="object_sq" class="form-label">Площадь м<sup>2</sup></label>
            <input type="number" class="form-control" id="object_sq" name="object_sq" placeholder="20 м²" min="1" max="1000" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="object_floor" class="form-label">Этаж размещения</small></label>
            <input type="number" class="form-control" id="object_floor" name="object_floor" placeholder="5 этаж" min="1" max="100" required>
        </div>
        <div class="mb-3">
            <label for="object_floors" class="form-label">Этажность здания</small></label>
            <input type="number" class="form-control" id="object_floors" name="object_floors" placeholder="15 этажей" min="1" max="100" required>
        </div>
        <div class="mb-3">
            <label for="object_rooms" class="form-label">Количество комнат</small></label>
            <input type="number" class="form-control" id="object_rooms" name="object_rooms" placeholder="3 комнаты" min="1" max="100" required>
        </div>

        <h3>Дополнительная информация</h3><hr>
        <div class="mb-3">
            <label for="object_material" class="form-label">Тип дома <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_material" name="object_material" placeholder="Панельный">
        </div>
        <div class="mb-3">
            <label for="object_metro" class="form-label">Станция метро <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_metro" name="object_metro" placeholder="ВДНХ">
        </div>

        <div class="mb-3">
            <label for="object_owner_name" class="form-label">Имя собственника <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_owner_name" name="object_owner_name" placeholder="Иванов Иван">
        </div>
        <div class="mb-3">
            <label for="object_owner_phone" class="form-label">Телефон собственника <small>(опционально)</small></label>
            <input type="tel" class="form-control" id="object_owner_phone" name="object_owner_phone" placeholder="+7 (900) 000-00-00">
        </div>

        <h3>Загрузка фотографий</h3><hr>
        <div class="mb-3">
            <label for="object_images" class="form-label">Выберите фотографии объекта</label>
            <input class="form-control" type="file" id="object_images" name="object_images[]" multiple accept="image/*,image/jpeg">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="object_ads" name="object_ads">
            <label class="form-check-label" for="object_ads">Метка рекламного объекта (будет недоступна связь и бронирование)</label>
        </div>
        <button type="submit" class="btn btn-primary">Опубликовать</button>
    </form>
</div>

<?=view("admin.layout.footer")?>
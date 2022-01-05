<?php
/**
 * @var array $object_types
 * @var object $object
 * @var array $images
 * @var bool $is_unpublished
 */
?>
<?=view("admin.layout.header", ["title" => "Редактирование объекта"])?>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>
<div class="container-fluid px-4">
    <h1 class="mt-4">Редактировать объект</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Управление объектами Take-Keys</li>
    </ol>

    <form method="post" enctype="multipart/form-data">
        <h3>Основная информация</h3><hr>
        <div class="mb-3">
            <label for="object_title" class="form-label">Заголовок объекта</label>
            <input type="text" class="form-control" id="object_title" name="object_title" placeholder="Комната 30 м² в 3-к., 5/15 эт." value="<?=$object->title?>" required>
        </div>
        <div class="mb-3">
            <label for="object_cost" class="form-label">Стоимость</label>
            <input type="number" class="form-control" id="object_cost" name="object_cost" required min="1000" placeholder="30 000" value="<?=$object->cost?>">
        </div>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_ad">Тип предложения</label>
            <select class="form-control" id="object_ad" name="object_ad" required>
                <option value="1" <?=$object->typeAd==OBJECT_RENT_TYPE?"selected":""?>>Сдам</option>
                <option value="2" <?=$object->typeAd==OBJECT_SELL_TYPE?"selected":""?>>Продам</option>
            </select>
        </div>
        <?php if(!$is_unpublished){ ?>
        <div class="mb-3">
            <label class="my-1 mr-2" for="object_type">Тип объекта</label>
            <select class="form-control" id="object_type" name="object_type" required>
                <?php foreach($object_types as $object_type){
                   echo("<option value='{$object_type->inpars_id}'>{$object_type->object_type_slug}</option>");
                } ?>
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
        <?php } ?>
        <div class="mb-3">
            <label for="object_desc" class="form-label">Описание объекта</label>
                <textarea class="form-control" id="object_desc" rows="3" name="object_desc" required><?=$object->description?></textarea>
        </div>

        <div class="mb-3">
            <label for="object_address" class="form-label">Адрес объекта</label>
            <input type="text" class="form-control" id="object_address" name="object_address" placeholder="Москва, ул. Маросейка, 10/1с3 " value="<?=$object->address?>" required>
        </div>
        <div class="form-row" style="display: flex">
            <div class="form-group col-md-6">
                <label for="object_lat" class="form-label">Широта</label>
                <input type="number" class="form-control" id="object_lat" name="object_lat" placeholder="55.558741" step="0.0000000001" value="<?=$object->lat?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="object_lng" class="form-label">Долгота</label>
                <input type="number" class="form-control" id="object_lng" name="object_lng" placeholder="37.378847" step="0.0000000001" value="<?=$object->lng?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="object_sq" class="form-label">Площадь м<sup>2</sup></label>
            <input type="number" class="form-control" id="object_sq" name="object_sq" placeholder="20 м²" min="1" max="1000" step="0.01" value="<?=$object->sq?>" required>
        </div>
        <div class="mb-3">
            <label for="object_floor" class="form-label">Этаж размещения</small></label>
            <input type="number" class="form-control" id="object_floor" name="object_floor" placeholder="5 этаж" min="1" max="100" value="<?=$object->floor?>" required>
        </div>
        <div class="mb-3">
            <label for="object_floors" class="form-label">Этажность здания</small></label>
            <input type="number" class="form-control" id="object_floors" name="object_floors" placeholder="15 этажей" min="1" max="100" value="<?=$object->floors?>" required>
        </div>
        <div class="mb-3">
            <label for="object_rooms" class="form-label">Количество комнат</small></label>
            <input type="number" class="form-control" id="object_rooms" name="object_rooms" placeholder="3 комнаты" min="1" max="100" value="<?=$object->rooms?>" required>
        </div>

        <h3>Дополнительная информация</h3><hr>
        <div class="mb-3">
            <label for="object_material" class="form-label">Тип дома <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_material" name="object_material" placeholder="Панельный" value="<?=$object->materialSlug?>">
        </div>
        <div class="mb-3">
            <label for="object_metro" class="form-label">Станция метро <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_metro" name="object_metro" placeholder="ВДНХ" value="<?=$object->metroSlug?>">
        </div>

        <div class="mb-3">
            <label for="object_owner_name" class="form-label">Имя собственника <small>(опционально)</small></label>
            <input type="text" class="form-control" id="object_owner_name" name="object_owner_name" placeholder="Иванов Иван" value="<?=$object->name?>">
        </div>
        <div class="mb-3">
            <label for="object_owner_phone" class="form-label">Телефон собственника <small>(опционально)</small></label>
            <input type="tel" class="form-control" id="object_owner_phone" name="object_owner_phone" placeholder="+7 (900) 000-00-00" value="<?=$object->phones?>">
        </div>
        <?php if(!$is_unpublished){ ?>
        <h3>Загрузка фотографий</h3><hr>
            <h4>Текущие фотографии:</h4>
            <ul class="list-group">
            <?php if(!empty($images)) {
                $time = time();
                foreach ($images as $image) {
                    echo("<li class='list-group-item flex-row d-flex align-items-center w-100'>
                            <div class='flex-fill'><img class='rounded' alt='pic' src='$image->path?$time' style='max-width: 75px; max-height: 75px;'> <a target='_blank' href='$image->path'>$image->path</a></div>
                            <div class='text-danger fs-5' style='cursor: pointer' onclick='removePhoto(this, {$image->id})'><i class='fas fa-trash-alt'></i></div>
                          </li>");
                }
            } ?>
            </ul>
            <div class="mb-3 mt-3">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Новые изображения добавятся в конце старых
                    </div>
                </div>
                <input class="form-control" type="file" id="object_images" name="object_images[]" multiple accept="image/*,image/jpeg">
            </div>
        <?php } ?>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="object_ads" name="object_ads" <?=$object->isAd==1?"checked":""?>>
            <label class="form-check-label" for="object_ads">Метка "Горячее предложение"</label>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?=view("admin.layout.footer")?>
<script type="text/javascript" src="/js/21232f297a57a5a743894a0e4a801fc3.js" charset="UTF-8"></script>

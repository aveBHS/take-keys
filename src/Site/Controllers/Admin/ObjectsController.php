<?php

namespace Site\Controllers\Admin;

use Site\Core\HttpRequest;
use Site\Models\AdsObjectSellModel;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;

class ObjectsController implements \Site\Controllers\Controller
{
    public function view(HttpRequest $request, $args)
    {
        // TODO: Implement view() method.
    }

    public function createView(HttpRequest $request, $args)
    {
        $object_types = ObjectTypeModel::select([]);
        $request->show(view("admin.objects.new", ['object_types' => $object_types]));
    }

    public function create(HttpRequest $request, $args)
    {
        $object = new ObjectModel();

        $object->title = $request->post("object_title");
        $object->cost = $request->post("object_cost");
        $object->categoryId = $request->post("object_type");
        $object->typeAd = $request->post("object_ad");
        $object->regionId = $request->post("object_region");
        $object->cityId = $request->post("object_city");
        $object->description = $request->post("object_desc");
        $object->address = $request->post("object_address");
        $object->lat = $request->post("object_lat");
        $object->lng = $request->post("object_lng");
        $object->sq = $request->post("object_sq");
        $object->floor = $request->post("object_floor");
        $object->floors = $request->post("object_floors");
        $object->rooms = $request->post("object_rooms");
        $object->materialSlug = $request->post("object_material");
        $object->metroSlug = $request->post("object_metro");
        $object->name = $request->post("object_owner_name");
        $object->phones = $request->post("object_owner_phone");
        $object->isAd = is_null($request->post("object_ads")) ? 0 : 1;

        $object->origin = "";
        $object->sectionId = 6; // Жилое помещение
        $object->status = 0; // Автоматически актуально

        try {
            $object->save();

            $url = "//".env("url")."/uploads/";
            if (isset($_FILES['object_images'])) {
                $files = array();
                $diff = count($_FILES['object_images']) - count($_FILES['object_images'], COUNT_RECURSIVE);
                if ($diff == 0) {
                    $files = array($_FILES['object_images']);
                } else {
                    foreach($_FILES['object_images'] as $k => $l) {
                        foreach($l as $i => $v) {
                            $files[$i][$k] = $v;
                        }
                    }
                }
                for ($i = 0; $i < count($files); $i++) {
                    try{
                        $file = $files[$i];
                        $name = "{$object->id}_$i.jpg";
                        move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/uploads/$name");

                        $image = new ImageModel();
                        $image->object_id = $object->id;
                        $image->path = $url.$name;
                        $image->save();
                    } catch (\Exception $exception) {
                        var_dump($exception);
                        die();
                    }
                }
            }

            $request->redirect("/id/{$object->id}");
        } catch (\Exception $exception){
            $request->setFlash("system_error", $exception->getMessage());
            $request->redirect_back();
        }
    }

    function publishObject(HttpRequest $request, $args){
        $request->setHeader("Content-Type", "application/json");

        if(!$args[0]) $request->redirect("/");
        $requestParams = [(int) $args[0]];
        $object = AdsObjectSellModel::find($requestParams[0]);

        if(!is_null($object)){
            $images = explode("|", $object->images);
            $new_images = [];
            for($i = 0; $i < count($images); $i++){
                $img = new ImageModel();
                $img->path = "//".env("url")."/uploads/{$object->id}_$i.jpg";
                exec("wget -O /var/www/site/public_html/uploads/{$object->id}_$i.jpg $images[$i]");
                array_push($new_images, $img);
            }

            if(mb_strtolower($object->categoryId) == "квартира"){
                $rooms = $object->rooms > 0 ? $object->rooms : 1;
                $object->categoryId = "$rooms-к квартира";
            }
            var_dump($object->categoryId);
            $category = ObjectTypeModel::find($object->categoryId, "object_type_slug")->object_type_id;
            var_dump($category);
            if(is_null($category)){
                $category = new ObjectTypeModel();
                $category->object_type_slug = mb_strtoupper($object->categoryId[0]).mb_substr($object->categoryId, 1);
                $category->price_adder = 10000;
                $category->price_subtractor = 10000;
                $category->inpars_id = 0;
                try{
                    $category->save();
                    $category=$category->object_type_id;
                } catch (\Exception $ex){
                    var_dump($ex);
                    bugReport($ex);
                    $request->show(json_encode([
                        "result" => "error",
                        "reason" => "Возникла ошибка при переносе, обратитесь за помощью к разработчику"
                    ]));
                    return;
                }
            }
            echo("\n-----------------------\n");


            $new_object = new ObjectModel();
            $new_object->title = $object->title;
            $new_object->description = $object->description;
            $new_object->lat = $object->lat;
            $new_object->lng = $object->lng;
            $new_object->address = $object->address;
            $new_object->cost = $object->cost;
            $new_object->metroId = 0;
            $new_object->name = $object->name;
            $new_object->phones = $object->phones;
            $new_object->rooms = $object->rooms;
            $new_object->floor = $object->floor;
            $new_object->floors = $object->floors;
            $new_object->sq = $object->sq;
            $new_object->categoryId = $category;
            $new_object->sectionId = 6;
            $new_object->typeAd = 1;
            $new_object->cityId = 1;
            $new_object->regionId = 77;
            $new_object->metroSlug = $object->metroSlug;
            $new_object->materialSlug = $object->materialSlug;
            $new_object->source = $object->source;
            $new_object->origin = $object->origin;
            $new_object->isAd = 1;
            $new_object->status = 0;

            try{
                $new_object->save();
                foreach($new_images as $image){
                    $image->object_id = $new_object->id;
                    $image->save();
                }
                $object->remove();
            } catch (\Exception $ex){
                var_dump($ex);
                bugReport($ex);
                $request->show(json_encode([
                    "result" => "error",
                    "reason" => "Возникла ошибка при переносе, обратитесь за помощью к разработчику"
                ]));
            }
        } else {
            $request->show(json_encode([
                "result" => "error",
                "reason" => "Объект не найден"
            ]));
        }
    }
}
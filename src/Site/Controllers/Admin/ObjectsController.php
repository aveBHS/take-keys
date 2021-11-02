<?php

namespace Site\Controllers\Admin;

use Site\Core\HttpRequest;
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
}
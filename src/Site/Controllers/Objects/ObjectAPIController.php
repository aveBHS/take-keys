<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;

class ObjectAPIController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function recent(HttpRequest $request, $args)
    {
        function nothing_found($request){
            $request->show("Ничего не найдено");
        }
        $recently_viewed = $request->getCookie("recently_viewed", true);
        if(!is_null($recently_viewed)) {
            try {
                $recently_viewed = json_decode($recently_viewed);
                if (is_null($recently_viewed)) {
                    nothing_found($request);
                    return;
                }
            } catch (\Exception $exception) {
                nothing_found($request);
                return;
            }
            $recently_viewed = array_reverse($recently_viewed);
            $objects = ObjectModel::findAll($recently_viewed, null, 10);

            if (is_null($objects)){
                nothing_found($request);
                return;
            } else {
                foreach($objects as $object){
                    $images = ImageModel::selectObjectImages($object->id);
                    $request->show(view("objects.item", [
                        'object' => $object,
                        'images' => $images,
                        'col_class' => "col-9 col-lg-5"
                    ]));
                }
                return;
            }
        }
        nothing_found($request);
    }
}
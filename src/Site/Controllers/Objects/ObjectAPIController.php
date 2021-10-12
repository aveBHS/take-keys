<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\RequestModel;

class ObjectAPIController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    private function nothing_found($request){
        $request->show("Ничего не найдено");
    }

    public function recent(HttpRequest $request, $args)
    {
        $recently_viewed = $request->getCookie("recently_viewed", true);
        if(!is_null($recently_viewed)) {
            try {
                $recently_viewed = json_decode($recently_viewed);
                if (is_null($recently_viewed)) {
                    $this->nothing_found($request);
                    return;
                }
            } catch (\Exception $exception) {
                $this->nothing_found($request);
                return;
            }
            $recently_viewed = array_reverse($recently_viewed);
            $objects = ObjectModel::findAll($recently_viewed, null, 10);

            if (is_null($objects)){
                $this->nothing_found($request);
            } else {
                foreach($objects as $object){
                    $images = ImageModel::selectObjectImages($object->id);
                    $request->show(view("objects.item", [
                        'object' => $object,
                        'images' => $images,
                        'col_class' => "col-9 col-lg-5"
                    ]));
                }
            }
            return;
        }
        $this->nothing_found($request);
    }

    public function recommendations(HttpRequest $request, $args)
    {
        global $auth;
        $requestModel = RequestModel::find($auth()->request_id);
        if($requestModel){
            $objectsIds = array_slice(array_reverse(explode(",", $requestModel->last_result)), 0, 10);
            $objects = ObjectModel::findAll($objectsIds);
            if (is_null($objects)){
                $this->nothing_found($request);
            } else {
                foreach ($objects as $object) {
                    $images = ImageModel::selectObjectImages($object->id);
                    $request->show(view("objects.item", [
                        'object' => $object,
                        'images' => $images,
                        'col_class' => "col-9 col-lg-5"
                    ]));
                }
            }
        } else {
            $this->nothing_found($request);
        }
    }
}
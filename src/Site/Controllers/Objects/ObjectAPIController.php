<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Models\CallResultModel;
use Site\Models\ImageModel;
use Site\Models\ObjectCallModel;
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
                $objects = ImageModel::selectObjectsImages($objects);
                foreach($objects as $object){
                    $request->show(view("objects.item", [
                        'object' => $object,
                        'images' => $object->images,
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
            $objects = ObjectModel::select(
                [
                    ["status", [[0, 1], 'in']],
                    ["id", [explode(",", $requestModel->recommendations), "in"]]
                ],
                [ ["created", "DESC"] ],
                10, 0, true
            ) ?? [];
            if (is_null($objects) || is_null($objects['result'])){
                $this->nothing_found($request);
            } else {
                $objects = $objects['result'];
                $objects = ImageModel::selectObjectsImages($objects);
                foreach ($objects as $object) {
                    if($object->status > 1) continue;
                    $request->show(view("objects.item", [
                        'object' => $object,
                        'images' => $object->images,
                        'col_class' => "col-9 col-lg-5"
                    ]));
                }
            }
        } else {
            $this->nothing_found($request);
        }
    }

    public function map(HttpRequest $request, $args){
        $request->setHeader("Content-Type", "application/json");
        $coords = json_decode($request->post("viewframe"));
        if(!is_null($coords)){
            $objects = ObjectModel::select(
                [
                    ["status", 0],
                    ["lat", [$coords[0][0], ">"]],
                    ["lng", [$coords[0][1], ">"]],
                    ["lat", [$coords[1][0], "<"]],
                    ["lng", [$coords[1][1], "<"]],
                ]
            );
        } else {
            $objects = ObjectModel::select([
                ["status", 0]
            ]);
        }

        $objects_json = [];
        $site_url = env("URL");
        foreach($objects as $object){
            array_push($objects_json, [
                "id" => $object->id,
                "geometry" => [
                    "coordinates" => [
                        $object->lat,
                        $object->lng
                    ],
                ],
                "properties" => [
                    "url" => "//$site_url/id/{$object->id}",
                    "price" => $object->cost
                ]
            ]);
        }
        $request->show(json_encode($objects_json));
    }

    public function mapRender(HttpRequest $request, $args)
    {
        $objects = ObjectModel::select([
            ["id", [
                json_decode($request->post("id")),
                "in"
            ]]
        ], [ ['created', 'DESC'] ]);
        $objects = ImageModel::selectObjectsImages($objects);
        foreach($objects as $object){
            $request->show(view("objects.item", [
                "object" => $object,
                "images" => $object->images
            ]));
        }
    }

    public function setFavorite(HttpRequest $request, $args)
    {
        global $auth;
        $request->setHeader("Content-Type", "application/json");
        $result = "NOT_ALLOWED";
        if(!is_null($auth())) {
            $object = ObjectModel::find($args[0]);

            $result = "NOT_FOUND";
            if (!is_null($object)) {
                $favorite_objects = explode(",", $auth()->request->favorites);
                if (is_null($auth()->request->favorites)) {
                    $favorite_objects = [];
                }
                if (in_array("{$object->id}", $favorite_objects)) {
                    unset($favorite_objects[array_search("{$object->id}", $favorite_objects)]);
                    $result = "REMOVED";
                } else {
                    array_push($favorite_objects, "{$object->id}");
                    $result = "ADDED";
                }
                $favorite_objects = implode(",", $favorite_objects);
                if (substr($favorite_objects, 0, 1) == ",")
                    $favorite_objects = substr($favorite_objects, 1);
                if (substr($favorite_objects, strlen($favorite_objects) - 2, 1) == ",")
                    $favorite_objects = substr($favorite_objects, 0, strlen($favorite_objects) - 2);
                $auth()->request->favorites = $favorite_objects;
                try {
                    $auth()->request->save();
                    if($result == "ADDED"){
                        userLog("Добавление объекта в избранное",
                            "Объект: ID {$object->id}");
                    } else {
                        userLog("Удаление объекта из избранного",
                            "Объект: ID {$object->id}");
                    }
                } catch (\Exception $ex) {
                    $result = "ERROR";
                }
            }
        }
        $request->show(json_encode([
            "result" => $result
        ]));
    }

    public function callResult(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");
        $result = CallResultModel::find($args[0]);
        if(!is_null($result)){
            global $auth;
            $call_result = ObjectCallModel::find($result->call_id);
            if($result->owner_id == $auth()->id && $call_result->call_status == OBJECT_CALL_DONE){
                $object = ObjectModel::find($result->object_id);
                $request->show(json_encode([
                    "result" => "ok",
                    "phone" => $object->phones
                ]));
            } else {
                $request->show(json_encode([
                    "result" => "error",
                    "reason" => "Ошибка доступа"
                ]));
            }
        } else {
            $request->show(json_encode([
                "result" => "error",
                "reason" => "Заявка не найдена"
            ]));
        }
    }
}
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
                    ["status", 0],
                    ["id", [explode(",", $requestModel->recommendations), "in"]]
                ],
                [ ["created", "DESC"] ],
                10, 0, true
            ) ?? [];
            if (is_null($objects)){
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
        $object = ObjectModel::find($args[0]);
        $images = ImageModel::selectObjectImages($object->id);
        $request->show(view("objects.item", ["object" => $object, "images" => $images]));
    }
}
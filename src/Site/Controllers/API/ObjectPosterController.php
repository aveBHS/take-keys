<?php

namespace Site\Controllers\API;

use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\PublicNumberModel;

class ObjectPosterController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function get_objects(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");
        $requests = PublicNumberModel::select([["status", POSTER_IN_WORK_STATUS], ["object_id", [0, ">"]]]);
        if(!is_null($requests)){
            $data = [
                "total" => count($requests),
                "data" => []
            ];

            $object_ids = [];
            foreach($requests as $req){
                array_push($object_ids, $req->object_id);
            }
            $objects = ImageModel::selectObjectsImages(ObjectModel::findAll($object_ids));
            foreach($requests as $req){
                foreach($objects as $object){
                    if($req->object_id == $object->id){
                        array_push($data["data"], [
                            "id" => $req->id,
                            "phone" => $req->phone,
                            "object" => $object
                        ]);
                    }
                }
            }
        } else {
            $data = [
                "total" => 0,
                "data" => []
            ];
        }
        $request->show(json_encode($data));
    }

    public function confirm_request(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");
        $req = PublicNumberModel::find((int) $request->post("id"));
        if(!is_null($req)){
            $req->status = POSTER_ACTIVE_STATUS;
            $req->identifier = $request->post("identifier");
            try{
                $req->save();
                $data = [
                    "result" => "OK"
                ];
            } catch (\Exception $exception){
                bugReport($exception);
                $data = [
                    "result" => "ERROR",
                    "reason" => "INTERNAL_ERROR"
                ];
            }
        } else {
            $data = [
                "result" => "ERROR",
                "reason" => "NOT_FOUND"
            ];
        }
        $request->show(json_encode($data));
    }
}
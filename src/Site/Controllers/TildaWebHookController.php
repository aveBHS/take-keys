<?php

namespace Site\Controllers;

use Site\Core\HttpRequest;
use Site\Models\ObjectType;
use Site\Models\Request;

class TildaWebHookController implements Controller
{

    public function view(HttpRequest $request, $args) { }

    public function process(HttpRequest  $request, $args): bool
    {
        $object = new Request();
        $objectInfo = json_decode($request->post('object'));
        if(!$objectInfo) return false;

        $object->phone = $request->post('phone');
        $object->email = $request->post("email");
        $object->lat = (float) $objectInfo->lat;
        $object->lng = (float) $objectInfo->lng;
        $object->price = (int) $objectInfo->price;
        $object->address = $objectInfo->address;
        $object->distance = (int) ($objectInfo->distance ?? 1000);
        if($object->distance < 1) $object->distance = 1000;

        $objectType = ObjectType::find($objectInfo->type);
        $object->object_type = (int) ($objectType->object_type_id ?? 1);

        try{
            return $object->save();
        } catch (\Exception $exception){
             $request->show($exception->getMessage());
             return false;
        }
    }
}
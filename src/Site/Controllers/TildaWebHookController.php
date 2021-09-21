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
        $objectInfo = json_decode($request->post('Object'));
        if (!$objectInfo) return false;

        $object->phone = trim($request->post('Phone'));
        $object->phone = str_replace(" ", "", $object->phone);
        $object->phone = str_replace("-", "", $object->phone);
        $object->phone = str_replace("+", "", $object->phone);
        $object->phone = str_replace("(", "", $object->phone);
        $object->phone = str_replace(")", "", $object->phone);
        if ($object->phone[0] == "8") $object->phone = "7" . substr($object->phone, 1);

        $object->email = trim($request->post("Email"));
        $object->lat = (float)$objectInfo->lat;
        $object->lng = (float)$objectInfo->lng;
        $object->price = (int)$objectInfo->price;
        $object->address = $objectInfo->address;
        $object->distance = (int)($objectInfo->distance ?? 1000);
        if ($object->distance < 1) $object->distance = 1000;

        $objectType = ObjectType::find($objectInfo->type);
        $object->object_type = (int)($objectType->object_type_id ?? 1);

        try{
            return $object->save();
        } catch (\Exception $exception){
             $request->show($exception->getMessage());
             return false;
        }
    }
}
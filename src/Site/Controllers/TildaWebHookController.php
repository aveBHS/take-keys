<?php

namespace Site\Controllers;

use Site\Controllers\Exceptions\InternalServerErrorController;
use Site\Core\HttpRequest;
use Site\Models\ObjectType;
use Site\Models\Request;

class TildaWebHookController implements Controller
{

    public function view(HttpRequest $request, $args) { }

    public function createRequest(HttpRequest  $request, $args): bool
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

    public function processPayment(HttpRequest $request, $args)
    {

        $userPhone = trim($request->post("Phone"));
        $userPhone = str_replace(" ", "", $userPhone);
        $userPhone = str_replace("-", "", $userPhone);
        $userPhone = str_replace("+", "", $userPhone);
        $userPhone = str_replace("(", "", $userPhone);
        $userPhone = str_replace(")", "", $userPhone);
        if ($userPhone[0] == "8") $userPhone = "7" . substr($userPhone, 1);


        if(!empty($userPhone)) {
            $requestObject = Request::find($userPhone, "phone");
            if (!is_null($requestObject)) {
                $requestObject->purchased = 1;
                try {
                    $requestObject->save();
                } catch (\Exception $exception) {
                    $request->returnException(new \Site\Controllers\Exceptions\InternalServerErrorController(), 503);
                }
            } else {
                $request->returnException(new \Site\Controllers\Exceptions\BadRequestController(), 400);
            }
        } else {
            $request->returnException(new \Site\Controllers\Exceptions\BadRequestController(), 200);
        }
    }
}
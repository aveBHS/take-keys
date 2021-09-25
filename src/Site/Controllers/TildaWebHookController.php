<?php

namespace Site\Controllers;

use Site\Controllers\Exceptions\InternalServerErrorController;
use Site\Core\HttpRequest;
use Site\Models\ObjectType;
use Site\Models\Request;
use stdClass;

class TildaWebHookController implements Controller
{

    public function view(HttpRequest $request, $args) { }

    function getPhone(string $phone){
        $phone = trim($phone);
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace("-", "", $phone);
        $phone = str_replace("+", "", $phone);
        $phone = str_replace("(", "", $phone);
        $phone = str_replace(")", "", $phone);
        if ($phone[0] == "8") $phone = "7" . substr($phone, 1);
        return $phone;
    }

    public function processRequest(HttpRequest $request, $args): bool
    {
        $userPhone = $this->getPhone($request->post('Phone'));
        $object = Request::find($userPhone, 'phone');
        $object_found = false;
        if(is_null($object)){
            $object = new Request();
            $objectInfo = json_decode($request->post('Object'));
            if (!$objectInfo) return false;
        } else {
            $object_found = true;
            $objectInfo = new stdClass();
            $objectInfo->lat = 0;
            $objectInfo->lng = 0;
            $objectInfo->address = $request->post("Address");
            $objectInfo->price = $request->post("Price");
            $objectInfo->distance = (int) $request->post("AreaRange") * 1000;
            if($objectInfo->distance < 1) $objectInfo->distance = null;
            $objectInfo->type = $request->post("ObjectType");
        }

        if(!$object_found) {
            $object->phone = $userPhone;
            $object->email = trim($request->post("Email"));
        }
        $object->lat = (float)$objectInfo->lat;
        $object->lng = (float)$objectInfo->lng;
        $object->price = (int)$objectInfo->price;
        $object->address = $objectInfo->address;
        $object->distance = (int)($objectInfo->distance ?? 1000);
        if ($object->distance < 1) $object->distance = 1000;

        $object->purchased = 0;

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

        $userPhone = $this->getPhone($request->post("Phone"));

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
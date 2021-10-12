<?php

namespace Site\Controllers\WebHook;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\InternalServerErrorController;
use Site\Core\HttpRequest;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;
use Site\Models\PhoneCallModel;
use Site\Models\RequestModel;
use Site\Models\UserModel;
use stdClass;

class TildaWebHookController implements Controller
{

    public function view(HttpRequest $request, $args) { }

    function getPhone($phone)
    {
        if (is_null($phone)) return null;
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
        $object = RequestModel::find($userPhone, 'phone');
        $object_found = false;
        if(is_null($object)){
            if (is_null($request->post("Registration"))) return false;
            $object = new RequestModel();
                $objectInfo = new stdClass();
            if(!is_null($request->post("ObjectInfo")) && !empty($request->post("ObjectInfo")))
                $objectInfo = json_decode($request->post("ObjectInfo"));
                if (is_null($objectInfo)) $objectInfo = new stdClass();
            $object->status = 1;
            $object->is_free = 0;
        } else {
            if (is_null($request->post("Edit"))) return false;
            if ($object->purchased != 1) return false;
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
            $object->email = strtolower(trim($request->post("Email")));
            $object->purchased = 0;
        } else {
            if($object->status == 5 || $object->status == 2){
                $object->status = 3;
            } else {
                $object->status = 4;
            }
        }
        $object->lat = (float)$objectInfo->lat;
        $object->lng = (float)$objectInfo->lng;
        $object->price = (int)$objectInfo->price;
        $object->address = $objectInfo->address;
        $object->distance = (int)($objectInfo->distance ?? 1000);
        if ($object->distance < 1) $object->distance = 1000;

        $objectType = ObjectTypeModel::find($objectInfo->type ?? "");
        $object->object_type = (int)($objectType->object_type_id ?? 1);

        try{
            $result = $object->save();
            if(!$object_found){
                $user = new UserModel();
                $user->login = $userPhone;
                $user->password = md5($request->post("Password"));
                $user->name = $request->post("Name");
                $user->request_id = $object->id;
                $user->save();

                $call = new PhoneCallModel();
                $call->phone = $userPhone;
                $call->call_type = PhoneCallModel::callTypes['REGISTRATION'];
                return $call->save();
            }
            return $result;
        } catch (\Exception $exception){
            $request->show($exception->getMessage());
            return false;
        }
    }

    public function removeRequest(HttpRequest $request, $args)
    {
        $userPhone = $this->getPhone($request->post('Phone'));
        if(!empty($userPhone)) {
            $object = RequestModel::find($userPhone, 'phone');
            if(!is_null($object)) {
                if ($object->status == 0)
                    $object->status = 4;
                else if($object->status == 4 || $object->status == 5)
                    $object->status = 0;
                else return null;
                try{
                    $object->save();
                } catch (\Exception $exception) {
                    $request->show($exception->getMessage());
                }
            }
        } else {
            $request->returnException(new \Site\Controllers\Exceptions\BadRequestController(), 200);
        }
    }

    public function processPayment(HttpRequest $request, $args)
    {

        $userPhone = $this->getPhone($request->post("Phone"));

        if(!empty($userPhone)) {
            $requestObject = RequestModel::find($userPhone, "phone");
            if (!is_null($requestObject)) {
                $requestObject->purchased = 1;
                if($requestObject->status == 3){
                    $requestObject->status = 4;
                }
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

    public function booking(HttpRequest $request, $args)
    {
        $phone = $this->getPhone($request->post("Phone"));
        $title = $request->post("ObjectTitle") ?? " ";
        if(is_null($title)) $title = " ";
        if(!is_null($phone)){
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/../booker_requests/$phone.txt", $title);
        } else {
            $request->returnException(new \Site\Controllers\Exceptions\BadRequestController(), 200);
        }
    }

    public function createAdObject(HttpRequest $request, $args): bool
    {
        $object = new ObjectModel();

        $object->title = $request->post("ObjectTitle");
        $object->description = $request->post("ObjectDesc");
        $object->address = $request->post("ObjectAddress");

        $object->lat = (float) $request->post("ObjectLat");
        $object->lng = (float) $request->post("ObjectLng");
        $object->cost = (int) $request->post("ObjectCost");

        $object->name = $request->post("ObjectOwnerName");
        $object->phones = $request->post("ObjectOwnerPhone");

        $object->rooms = (int) $request->post("ObjectRooms");
        $object->floor = (int) $request->post("ObjectFloor");
        $object->floors = (int) $request->post("ObjectFloors");
        $object->sq = (int) $request->post("ObjectSQ");

        $object->categoryId = (int) $request->post("ObjectCategoryId");
        $object->sectionId = (int) $request->post("ObjectSectionId");
        $object->typeAd = (int) $request->post("ObjectTypeAd");
        $object->cityId = (int) $request->post("ObjectCityId");
        $object->regionId = (int) $request->post("ObjectRegionId");

        $object->metroSlug = $request->post("ObjectMetroName");
        $object->materialSlug = $request->post("ObjectMaterial");

        $object->isAd = 1;
        $object->status = 0;

        try{
            return $object->save();
        } catch (\Exception $exception){
            $request->show($exception->getMessage());
            return false;
        }
    }
}
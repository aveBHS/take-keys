<?php

namespace Site\Controllers\WebHook;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\InternalServerErrorController;
use Site\Core\HttpRequest;
use Site\Models\ObjectModel;
use Site\Models\ObjectType;
use Site\Models\Request;
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
        $object = Request::find($userPhone, 'phone');
        $object_found = false;
        if(is_null($object)){
            $object = new Request();
            $objectInfo = json_decode($request->post('Object'));
            if (!$objectInfo) return false;

            $object->status = 1;
            $object->is_free = (int) ($request->post("EFM") ?? 1);
            if($object->is_free != 1 or $object->is_free != 0)
                $object->is_free = 1;
        } else {
            $object_found = true;
            if (!is_null($request->post("Registration"))) return false;
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
            $object->purchased = 0;
        }
        $object->lat = (float)$objectInfo->lat;
        $object->lng = (float)$objectInfo->lng;
        $object->price = (int)$objectInfo->price;
        $object->address = $objectInfo->address;
        $object->distance = (int)($objectInfo->distance ?? 1000);
        if ($object->distance < 1) $object->distance = 1000;

        $objectType = ObjectType::find($objectInfo->type);
        $object->object_type = (int)($objectType->object_type_id ?? 1);

        try{
            $result = $object->save();
            if(!$object_found){
                $user = new UserModel();
                $user->login = $userPhone;
                $user->password = md5($request->post("Password"));
                $user->request_id = $object->id;
                return $user->save();
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
            $object = Request::find($userPhone, 'phone');
            if(!is_null($object)) {
                $object->status = 0;
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
            $requestObject = Request::find($userPhone, "phone");
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
        $title = $request->post("ObjectTitle");
        if(!is_null($phone) and !is_null($title)){
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
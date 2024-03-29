<?php

namespace Site\Controllers\Objects;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\NotFoundController;
use Site\Core\AuthService;
use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\RequestModel;

class CardController implements Controller
{
    function view(HttpRequest $request, $args){
        global $auth;

        if(!$args[0]) $request->redirect("/");
        if(ctype_digit($args[0]))
            $requestParams = [(int) $args[0]];
        else
            $requestParams = explode(":", base64_decode($args[0]));
        if (count($requestParams) > 1) {
            $object = (new ObjectModel())->find($requestParams[1]);
            $requestUser = RequestModel::find($requestParams[0], 'id');
            if (!is_null($requestUser)){
                $auth->directLogin($requestUser->id);
                $auth = new AuthService($request);
            }
            $purchased = !is_null($requestUser) && (($requestUser->purchased ?? 0) == 1);
        } else {
            $purchased = false;
            if($auth()){
                $requestUser = RequestModel::find($auth()->request_id, 'id');
                $purchased = !is_null($requestUser) && (($requestUser->purchased ?? 0) == 1);
            }
            $object = (new ObjectModel())->find($requestParams[0]);
        }

        if(!is_null($object)){
            $recently_viewed = $request->getCookie("recently_viewed", true);
            if(is_null($recently_viewed)){
                $request->setCookie("recently_viewed", [$object->id], true);
            } else {
                try {
                    $recently_viewed = json_decode($recently_viewed);
                    if (!is_null($recently_viewed)) {
                        if (!in_array($object->id, $recently_viewed)) {
                            array_push($recently_viewed, $object->id);
                            $request->setCookie("recently_viewed", $recently_viewed, true);
                        }
                    }
                } catch (\Exception $exception) {}
            }

            $images = ImageModel::selectObjectImages($object->id);
            $request->show(view("objects.card", ["object" => $object, "images" => $images, "requestId" => $requestUser->id ?? 0, "purchased" => $purchased]));
        } else {
            $object = ObjectModel::find($requestParams[0], "inpars_id");
            if(!is_null($object)){
                $request->redirect("/id/{$object->id}");
                return;
            }
            $request->returnException(new NotFoundController(), 404);
        }
    }
}
<?php

namespace Site\Controllers\Objects;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\NotFoundController;
use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\Request;

class CardController implements Controller
{
    function view(HttpRequest $request, $args){
        if(!$args[0]) $request->redirect("/");
        if(!strrpos(base64_decode($args[0]), ":"))
            $requestParams = [(int) $args[0]];
        else
            $requestParams = explode(":", base64_decode($args[0]));
        if (count($requestParams) > 1) {
            $object = (new ObjectModel())->find($requestParams[1]);
            $requestUser = Request::find($requestParams[0], 'id');
            $purchased = !is_null($requestUser) && (($requestUser->purchased ?? 0) == 1);
        } else {
            $object = (new ObjectModel())->find($requestParams[0]);
            $purchased = false;
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
            $request->show(view("objects.card", ["object" => $object, "images" => $images, "purchased" => $purchased]));
        } else {
            $request->returnException(new NotFoundController(), 404);
        }
    }
}
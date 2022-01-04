<?php

namespace Site\Controllers\Admin;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\NotFoundController;
use Site\Core\AuthService;
use Site\Core\HttpRequest;
use Site\Models\AdsObjectSellModel;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;
use Site\Models\RequestModel;

class CardController implements Controller
{
    function view(HttpRequest $request, $args){

        if(!$args[0]) $request->redirect("/");
        $requestParams = [(int) $args[0]];
        $object = AdsObjectSellModel::find($requestParams[0]);

        if(!is_null($object)){
            $images = [];
            foreach(explode("|", $object->images) as $image){
                $img = new ImageModel();
                $img->path = $image;
                array_push($images, $img);
            }
            $request->show(view("admin.objects.card", ["object" => $object, "images" => $images, "requestId" => 0, "purchased" => true]));
        } else {
            $request->returnException(new NotFoundController(), 404);
        }
    }

}
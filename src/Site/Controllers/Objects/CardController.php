<?php

namespace Site\Controllers\Objects;

use Site\Controllers\Controller;
use Site\Controllers\Exceptions\NotFoundController;
use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;

class CardController implements Controller
{
    function view(HttpRequest $request, $args){
        if(!$args[0]) $request->redirect("/");
        $object = (new ObjectModel())->find($args[0]);
        if(!is_null($object)){
            $images = (new ImageModel())->selectObjectImages($object->id);
            $request->show(view("objects.card", ["object" => $object, "images" => $images]));
        } else {
            $request->returnException(new NotFoundController(), 404);
        }
    }
}
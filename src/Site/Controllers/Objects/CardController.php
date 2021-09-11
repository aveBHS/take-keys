<?php

namespace Site\Controllers\Objects;

use Site\Controllers\Exceptions;
use Site\Models\ObjectModel;

class CardController
{
    function view($request, int $object_id){
        $object = (new ObjectModel())->find($object_id);
        if(!is_null($object)){
            view("objects.card", ["object" => $object]);
        } else {
            render($request, Exceptions\NotFoundController::class, "view");
        }
    }
}
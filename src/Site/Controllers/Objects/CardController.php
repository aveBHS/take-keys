<?php

namespace Site\Controllers\Objects;

use Site\Controllers\Exceptions;
use Site\Models\ObjectModel;

class CardController
{
    function view(int $object_id){
        $object = (new ObjectModel())->find($object_id);
        if(!is_null($object)){
            echo "
            <h1>{$object->title}</h1>
            <p>{$object->description}</p>
            <p><i>{$object->address}</i></p>
            <p><b>Цена: </b>{$object->cost}</p>
            ";
        } else {
            render(Exceptions\NotFoundController::class, "view");
        }
    }
}
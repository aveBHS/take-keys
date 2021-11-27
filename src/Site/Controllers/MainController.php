<?php

namespace Site\Controllers;

use \Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;
use Site\Models\ReviewModel;

class MainController implements Controller
{
    public function view(HttpRequest $request, $args)
    {
        $objects = ObjectModel::select(
            [
                ["categoryId", ObjectTypeModel::find(1, 'object_type_id')->inpars_id],
                ["cost", ["15000", ">="]]
            ],
            [ ["created", "DESC"] ],
            10
        );
        if(!is_null($objects))
            $objects = ImageModel::selectObjectsImages($objects);
        $reviews = ReviewModel::select([], [["created", "DESC"]], 5);
        $request->show(view("index", [
            "objects" => $objects,
            "reviews" => $reviews
        ]));
    }

    public function test(HttpRequest $request, $args)
    {
        $request->show(view("test"));
    }
}
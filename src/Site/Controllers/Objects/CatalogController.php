<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\RequestModel;

class CatalogController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        // TODO: Main catalog view
    }

    public function recommendations(HttpRequest $request, $args)
    {
        global $auth;

        $page = 0;
        if(isset($args[0])){
            $page = ((int) $args[0]) - 1;
            if ($page < 0) $page = 0;
        }

        $req = RequestModel::find($auth()->request_id);
        $objects = ObjectModel::findAll(
            explode(",", $req->last_result),
            null,
            env("elements_per_page") ?? 25,
            env("elements_per_page") ?? 25 * $page
        );

        $objects = ImageModel::selectObjectsImages($objects);

        $request->show(view("objects.catalog", ["objects" => $objects]));
    }
}
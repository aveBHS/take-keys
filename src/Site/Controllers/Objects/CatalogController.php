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
        global $auth;

        $page = 0;
        if(isset($args[0])){
            $page = ((int) $args[0]) - 1;
            if ($page < 0) $page = 0;
        }

        $objects = ObjectModel::select(
            [ "status" => 0 ],
            [ ["created", "DESC"] ],
            env("elements_per_page") ?? 25,
            env("elements_per_page") ?? 25 * $page,
            true
        );
        $totalObjects = $objects['total'];
        $objects = $objects['result'];

        $objects = ImageModel::selectObjectsImages($objects);

        if(is_null($request->getCookie("catalog_view_mode"))){
            $request->setCookie("catalog_view_mode", "tiles");
        }

        $request->show(view("objects.catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "title"             => "Каталог недвижимости",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog"
        ]));
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

        $request->show(view("objects.catalog", [
            "objects_count" => count(explode(",", $req->last_result)),
            "objects"       => $objects,
            "title"         => "Рекомендации недвижимости",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog/recommendations"
        ]));
    }
}
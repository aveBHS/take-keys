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

        $filter = [ ["status", 0] ];
        if(!is_null($auth()) and $auth()->purchased == 1)
            $filter = [ ["status", 0], ['isAd', 0] ];
        $objects = ObjectModel::select(
            $filter,
            [ ["created", "DESC"] ],
            env("elements_per_page") ?? 25,
            env("elements_per_page") ?? 25 * $page,
            true
        );
        if(is_null($objects) and $page > 0){
            $request->redirect("/catalog");
            return;
        }

        $totalObjects = $objects['total'] ?? 0;
        $objects = $objects['result'] ?? [];

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

        $objects = ObjectModel::select(
                [
                    ["status", [[0, 1], 'in']],
                    ["id", [explode(",", $auth()->request->recommendations), "in"]]
                ],
                [ ["created", "DESC"] ],
                env("elements_per_page") ?? 25,
                env("elements_per_page") ?? 25 * $page,
                true
            ) ?? [];

        if(is_null($objects) and $page > 0){
            $request->redirect("/catalog/recommendations");
            return;
        }

        $totalObjects = $objects['total'] ?? 0;
        $objects = $objects['result'] ?? [];

        $objects = ImageModel::selectObjectsImages($objects);

        $request->show(view("objects.catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "title"             => "Рекомендации недвижимости",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog/recommendations"
        ]));
    }

    public function favorites(HttpRequest $request, $args)
    {
        global $auth;

        $page = 0;
        if(isset($args[0])){
            $page = ((int) $args[0]) - 1;
            if ($page < 0) $page = 0;
        }

        $objects = ObjectModel::select(
                [
                    ["id", [explode(",", $auth()->request->favorites), "in"]]
                ],
                env("elements_per_page") ?? 25,
                env("elements_per_page") ?? 25 * $page,
                true
            ) ?? [];

        if(is_null($objects) and $page > 0){
            $request->redirect("/catalog/favorites");
            return;
        }

        $totalObjects = $objects['total'] ?? 0;
        $objects = $objects['result'] ?? [];

        $objects = ImageModel::selectObjectsImages($objects);
        $objects = array_reverse($objects);

        $request->show(view("objects.catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "title"             => "Избранные объявления",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog/favorites"
        ]));
    }

    public function map(HttpRequest $request, $args)
    {
        $request->show(view("objects.map"));
    }
}
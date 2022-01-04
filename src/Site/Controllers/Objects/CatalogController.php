<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Models\ImageModel;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;

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
        if($auth()->request->purchased)
            $filter = [ ["status", 0], ['isAd', 0] ];
        if(!is_null($request->get("filter-object-type")) && !in_array("any", $request->get("filter-object-type"))){
            $categories = [];
            foreach($request->get("filter-object-type") as $object_type) {
                $objects_type = ObjectTypeModel::find($object_type, "object_type_slug");
                if(!is_null($objects_type)) {
                    array_push($categories, $objects_type->inpars_id);
                }
            }
            if(!empty($categories)){
                array_push($filter, ["categoryId", [$categories, "in"]]);
            }
        }
        if(!is_null($request->get("filter-rooms")) and !in_array("any", $request->get("filter-rooms"))){
            array_push($filter, ["rooms", [$request->get("filter-rooms"), "in"]]);
        }
        if(!is_null($request->get("filter-price"))){
            $min_price = (int) explode(";", $request->get("filter-price"))[0];
            $max_price = (int) explode(";", $request->get("filter-price"))[1];
            if(!is_null($max_price) and !is_null($min_price)){
                if($min_price > $max_price){
                    list($min_price, $max_price) = [$max_price, $max_price];
                }
                array_push($filter, ["cost", [$min_price, ">="]]);
                array_push($filter, ["cost", [$max_price, "<="]]);
            }
        }
        if(!is_null($request->get("geo_lon")) and !is_null($request->get("geo_lat"))){
            if((float) $request->get("geo_lon") > 0 and (float) $request->get("geo_lat") and (float) $request->get("filter-radius") > 0){
                $search = calcCircle((float) $request->get("geo_lat"), (float) $request->get("geo_lon"), (float) $request->get("filter-radius") * 1000);
                array_push($filter, ["lat", [$search[0][0], "<="]]);
                array_push($filter, ["lat", [$search[3][0], ">="]]);
                array_push($filter, ["lng", [$search[1][1], "<="]]);
                array_push($filter, ["lng", [$search[2][1], ">="]]);
            }
        }
        if(!is_null($request->get("filter-actuality")) && ((int) $request->get("filter-actuality") > 0)){
            $time = time() - ((int) $request->get("filter-actuality")) * 3600;
            array_push($filter, ["created", [date("Y-m-d 00:00:00", $time), ">="]]);
        }

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

        $objects_types = ObjectTypeModel::select([]);

        $request->show(view("objects.catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "title"             => "Каталог недвижимости",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog",
            "objects_types"     => $objects_types,
            "filter_type"       => FILTER_CATALOG
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

        $objects_types = ObjectTypeModel::select([]);

        $request->show(view("cabinet.lk_catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "objects_types"     => $objects_types,
            "title"             => "Рекомендации недвижимости",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog/recommendations",
            "filter_type"       => FILTER_RECOMMENDATIONS_CONFIG,
            "current_page_slug" => LK_RECOMMENDATIONS_PAGE
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
                null,
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

        $objects_types = ObjectTypeModel::select([]);

        $request->show(view("cabinet.lk_catalog", [
            "objects_count"     => $totalObjects,
            "objects"           => $objects,
            "title"             => "Избранные объявления",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page,
            "origin_url"        => "/catalog/favorites",
            "objects_types"     => $objects_types,
            "filter_type"       => FILTER_NONE,
            "current_page_slug" => LK_FAVORITES_PAGE
        ]));
    }

    public function recent(HttpRequest $request, $args)
    {
        $recently_viewed = $request->getCookie("recently_viewed", true);
        do {
            if (!is_null($recently_viewed)) {

                $page = 0;
                if (isset($args[0])) {
                    $page = ((int)$args[0]) - 1;
                    if ($page < 0) $page = 0;
                }

                try {
                    $recently_viewed = json_decode($recently_viewed);
                    if (is_null($recently_viewed)) {
                        break;
                    }
                } catch (\Exception $exception) {
                    break;
                }
                $recently_viewed = array_reverse($recently_viewed);

                $objects = ObjectModel::select(
                        [
                            ["id", [$recently_viewed, "in"]]
                        ],
                        null,
                        env("elements_per_page") ?? 25,
                        env("elements_per_page") ?? 25 * $page,
                        true
                    ) ?? [];

                if (is_null($objects) and $page > 0) {
                    $request->redirect("/catalog/recent");
                    return;
                }

                $totalObjects = $objects['total'] ?? 0;
                $objects = $objects['result'] ?? [];

                $objects = ImageModel::selectObjectsImages($objects);
                $objects = array_reverse($objects);
            }
        } while(false);

        $request->show(view("cabinet.lk_catalog", [
            "objects_count"     => $totalObjects ?? 0,
            "objects"           => $objects ?? [],
            "title"             => "Недавно просмотренные объявления",
            "elements_per_page" => env("elements_per_page") ?? 25,
            "current_page"      => $page ?? 0,
            "origin_url"        => "/catalog/recent",
            "filter_type"       => FILTER_NONE,
            "current_page_slug" => LK_RECENT_PAGE
        ]));
    }

    public function map(HttpRequest $request, $args)
    {
        $request->show(view("objects.map"));
    }
}
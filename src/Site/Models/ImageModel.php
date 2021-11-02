<?php

namespace Site\Models;

use Site\Core\HttpRequest;

class ImageModel extends \Site\Models\Model
{
    protected $fields = [
        "object_id", "path"
    ];
    public static function selectObjectImagesById(array $objectsIds)
    {
        $objectsIdsString = [];
        for($i = 0; $i < count($objectsIds); $i++)
            if((int) $objectsIds[$i] > 0)
                array_push($objectsIdsString, (int) $objectsIds[$i]);
        $objectsIds = implode(",", $objectsIdsString);

        return self::query(
            "SELECT `path`, `object_id` FROM `images` WHERE `object_id` IN ($objectsIds)"
        );
    }
    public static function selectObjectImages(int $objectId){
        return self::selectObjectImagesById([$objectId]);
    }
    public static function selectObjectsImages(array $objects): array
    {
        $objectsIds = [];
        for($i = 0; $i < count($objects); $i++){
            array_push($objectsIds, $objects[$i]->id);
        }
        $objectsImages = self::selectObjectImagesById($objectsIds);
        for($i = 0; $i < count($objects); $i++){
            $objects[$i]->images = [];
            foreach ($objectsImages as $image){
                if($image->object_id == $objects[$i]->id){
                    array_push($objects[$i]->images, $image);
                }
            }
        }
        return $objects;
    }
}
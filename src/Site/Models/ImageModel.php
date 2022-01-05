<?php

namespace Site\Models;

use Site\Core\HttpRequest;

class ImageModel extends \Site\Models\Model
{
    protected $fields = [
        "object_id", "path"
    ];
    public static function selectObjectImages(int $objectId){
        return self::select([['object_id', [[$objectId], 'in']]]);
    }
    public static function selectObjectsImages(array $objects): array
    {
        $objectsIds = [];
        for($i = 0; $i < count($objects); $i++){
            array_push($objectsIds, $objects[$i]->id);
        }
        $objectsImages = self::select([['object_id', [$objectsIds, 'in']]]);
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
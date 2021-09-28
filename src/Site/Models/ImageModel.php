<?php

namespace Site\Models;

use Site\Core\HttpRequest;

class ImageModel extends \Site\Models\Model
{
    public static function selectObjectImages(int $objectId)
    {
        $model = new self();
        return $model->query(
            "SELECT `path` FROM `images` WHERE `object_id` = ?",
            [$objectId],
            "i"
        );
    }
}
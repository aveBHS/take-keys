<?php

namespace Site\Models;

use Site\Core\HttpRequest;

class ImageModel extends \Site\Models\Model
{
    function selectObjectImages(int $objectId)
    {
        return $this->query(
            "SELECT `path` FROM `images` WHERE `object_id` = ?",
            [$objectId],
            "i"
        );
    }
}
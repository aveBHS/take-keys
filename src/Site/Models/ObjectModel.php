<?php

namespace Site\Models;

class ObjectModel extends Model
{
    protected $tableName = "objects";
    protected $fields = [
        "id", "title", "description", "address", "lat", "lng", "cost",
        "name", "phones", "rooms", "floor", "floors", "sq",
        "categoryId", "sectionId", "typeAd", "cityId", "regionId",
        "metroSlug", "materialSlug", "isAd", "status", "origin"
    ];
}
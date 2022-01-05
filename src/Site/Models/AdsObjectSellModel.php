<?php

namespace Site\Models;

class AdsObjectSellModel extends ObjectModel
{
    protected $tableName = "moscow_sell";
    protected $fields = [
        "id", "title", "description", "address", "lat", "lng", "cost",
        "name", "phones", "rooms", "floor", "floors", "sq",
        "categoryId", "metroSlug", "materialSlug", "origin"
    ];
}
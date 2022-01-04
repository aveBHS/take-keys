<?php

namespace Site\Models;

class ObjectTypeModel extends Model
{
    protected $tableId = "object_type_id";
    protected $tableName = "object_types";
    protected $fields = [
        "object_type_slug",
        "price_adder",
        "price_subtractor"
    ];
}
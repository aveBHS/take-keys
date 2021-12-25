<?php

namespace Site\Models;

class ObjectCallModel extends Model
{
    protected $tableName = "objects_calls";
    protected $fields = [
        "object_id", "result_time"
    ];
}
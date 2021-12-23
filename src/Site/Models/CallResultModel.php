<?php

namespace Site\Models;

class CallResultModel extends Model
{
    protected $tableName = "call_results";
    protected $fields = [
        "object_id",
        "owner_id",
        "result_id",
        "created_at"
    ];
}
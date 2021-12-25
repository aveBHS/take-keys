<?php

namespace Site\Models;

class CallResultModel extends Model
{
    protected $tableName = "call_results";
    protected $fields = [
        "object_id",
        "owner_id",
        "call_id",
        "show_at"
    ];
}
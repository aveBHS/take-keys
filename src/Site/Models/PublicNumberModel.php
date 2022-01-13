<?php

namespace Site\Models;

class PublicNumberModel extends Model
{
    protected $tableName = "public_numbers";
    protected $fields = ["phone", "object_id", "status", "updated"];
}
<?php

namespace Site\Models;

class PhoneCallModel extends Model
{
    protected $tableName = "calls";
    protected $fields = ['phone', 'call_type', 'call_status'];
    const callTypes = [
        "REGISTRATION" => 0,
        "OWNER_CHECK"  => 1,
        "ADS_OBJECT"   => 2
    ];
    const callStatuses = [
        "NEW"     => 0,
        "CREATED" => 1,
        "SUCCESS" => 2,
        "FAIL"    => 3,
        "LIMIT"   => 4
    ];
}
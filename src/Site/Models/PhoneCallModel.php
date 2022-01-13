<?php

namespace Site\Models;

class PhoneCallModel extends Model
{
    protected $tableName = "calls";
    protected $fields = ['phone', 'call_type', 'call_status', 'next_attempt'];
    const callTypes = [
        "REGISTRATION"  => 0,
        "OWNER_CHECK"   => 1,
        "ADS_OBJECT"    => 2,
        "FIRST_CONNECT" => 3
    ];
    const callStatuses = [
        "NEW"     => 0,
        "CREATED" => 1,
        "SUCCESS" => 2,
        "FAIL"    => 3,
        "LIMIT"   => 4
    ];
}
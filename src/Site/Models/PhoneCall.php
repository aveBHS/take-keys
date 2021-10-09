<?php

namespace Site\Models;

class PhoneCall extends Model
{
    protected $tableName = "calls";
    protected $fields = ['phone', 'call_type'];
    const callTypes = [
        "REGISTRATION" => 0,
        "OWNER_CHECK" => 1
    ];
}
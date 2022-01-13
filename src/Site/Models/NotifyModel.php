<?php

namespace Site\Models;

class NotifyModel extends Model
{
    protected $tableName = "notifies";
    protected $fields = [
        "user_id", "text", "type", "status"
    ];
    const notifyType = [
        "WHATSAPP" => "whatsapp",
        "SMS" => "sms",
        "ROBOT_CALL" => "call",
        "PACT" => "pact"
    ];
}
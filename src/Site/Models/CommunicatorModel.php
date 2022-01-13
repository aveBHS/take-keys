<?php

namespace Site\Models;

class CommunicatorModel extends Model
{
    protected $tableName = "communication";
    protected $fields = [
        "user_id", "phone", "conversation_id",
        "scenario_stage", "scenario"
    ];
}
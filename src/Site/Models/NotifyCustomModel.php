<?php

namespace Site\Models;

class NotifyCustomModel extends Model
{
    protected $tableName = "notify_custom";
    protected $fields = [
        "user_id", "content", "title", "buttons", "link", "show_at"
    ];
}
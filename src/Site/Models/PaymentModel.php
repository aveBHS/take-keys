<?php

namespace Site\Models;

/**
 * @property int $user_id
 * @property int $amount
 * @property int $status
 * @property string $token
 * @property int $next_attempt
 */
class PaymentModel extends Model
{
    protected $fields = ['user_id', 'amount', 'token', 'next_attempt', 'status'];
    const STATUSES = [
        "WAIT_FIRST"    => 0,
        "READY"         => 1,
        "DONE"          => 2,
        "WAIT_USER_PAY" => 3
    ];
}
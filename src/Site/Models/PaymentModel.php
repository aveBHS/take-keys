<?php

namespace Site\Models;

/**
 * @property int $user_id
 * @property int $amount
 * @property string $token
 * @property int $next_attempt
 */
class PaymentModel extends Model
{
    protected $fields = ['user_id', 'amount', 'token', 'next_attempt'];
}
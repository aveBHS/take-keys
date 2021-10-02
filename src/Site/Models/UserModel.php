<?php

namespace Site\Models;

/**
 * @property $id
 * @property $login
 * @property $password
 */
class UserModel extends Model
{
    protected $fields = [
        'login', 'password', 'request_id', 'remember_token',
        'email_token', 'reset_token'
    ];
}
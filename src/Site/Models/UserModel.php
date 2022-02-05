<?php

namespace Site\Models;

/**
 * @property $id
 * @property $login
 * @property $password
 * @property $name
 * @property $request_id
 */
class UserModel extends Model
{
    protected $fields = [
        'login', 'password', 'name', 'request_id',
        'remember_token', 'email_token', 'reset_token', 'anket'
    ];
}
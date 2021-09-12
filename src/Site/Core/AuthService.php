<?php

namespace Site\Core;

use http\Client\Curl\User;
use Site\Models\Model;
use Site\Models\UserModel;

class AuthService
{
    protected $id;
    protected $model = null;

    public function __construct()
    {
        if(isset($_SESSION['id'])){
            $model = UserModel::find($_SESSION['id']);
            if($model) $this->model = $model;
        } else if($_COOKIE['auth_token']){
            $model = UserModel::find($_COOKIE['auth_token'], "token");
            if($model) $this->authenticate($model);
        }
    }

    public function __invoke(): Model
    {
        return $this->model;
    }

    private function authenticate(Model $user)
    {
        $_SESSION['id'] = $user->id;
    }

    private function logout()
    {
        session_destroy();
    }
}
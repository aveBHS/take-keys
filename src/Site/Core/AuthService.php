<?php

namespace Site\Core;

use http\Client\Curl\User;
use Site\Models\Model;
use Site\Models\UserModel;

class AuthService
{
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

    public function __invoke()
    {
        return $this->model;
    }

    private function authenticate(Model $user)
    {
        $_SESSION['id'] = $user->id;
    }

    public function login(string $login, string $password)
    {
        if($this->model) return null;
        $user = UserModel::find($login, "login");
        if($user){
            if($user->password == md5($password)){
                $this->authenticate($user);
            } else {
                return null;
            }
        }
    }

    public function logout()
    {
        session_destroy();
    }
}
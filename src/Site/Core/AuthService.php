<?php

namespace Site\Core;

use http\Client\Curl\User;
use Site\Models\Model;
use Site\Models\Request;
use Site\Models\UserModel;

class AuthService
{
    protected $model = null;
    private $authMethod = null;

    public function __construct($authMethod = UserModel::class)
    {
        $this->authMethod = $authMethod;
        if(isset($_SESSION['id'])){
            $model = $this->authMethod::find($_SESSION['id']);
            if($model) $this->model = $model;
        } else if($_COOKIE['auth_token']){
            $model = $this->authMethod::find($_COOKIE['auth_token'], "token");
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

    public function login(string $login, string $password): bool
    {
        if($this->model) return true;
        $user = $this->authMethod::find(strtolower($login), "login");
        if($user){
            if($user->password == md5($password)){
                $this->authenticate($user);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function logout()
    {
        session_destroy();
    }

    public function tempLogin(int $id)
    {
        $request = Request::find($id);
        if (!is_null($request)) $this->authenticate($request);
    }
}
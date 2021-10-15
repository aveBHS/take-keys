<?php

namespace Site\Core;

use http\Client\Curl\User;
use Site\Models\Model;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class AuthService
{
    protected $httpRequest;
    protected $model = null;

    public function __construct(HttpRequest $request)
    {
        $this->httpRequest = $request;
        if(isset($_SESSION['id'])){
            $model = UserModel::find($_SESSION['id']);
            if($model){
                $this->model = $model;
                $this->model->request = RequestModel::find($this->model->request_id);
            }
        } else if($this->httpRequest->getCookie("auth_token")){
            $model = UserModel::find($this->httpRequest->getCookie("auth_token"), "remember_token");
            if($model){
                $this->authenticate($model);
            }
        }
    }

    public function __invoke()
    {
        return $this->model;
    }

    public function genAuthToken(Model $user): string
    {
        return md5($user->password."_".time()."_".$user->login);
    }

    private function authenticate(Model $user, bool $remember = true)
    {
        $this->model = $user;
        $_SESSION['id'] = $user->id;
        if($remember) {
            if(!empty($user->remember_token)){
                $token_expires = time() + 60 * 60 * 24 * 30 * 12;
                $this->httpRequest->setCookie('auth_token', $user->remember_token, false, $token_expires);
            } else {
                $user->remember_token = $this->genAuthToken($user);
                try {
                    $user->save();
                    $token_expires = time() + 60 * 60 * 24 * 30 * 12;
                    $this->httpRequest->setCookie('auth_token', $user->remember_token, false, $token_expires);
                } catch (\Exception $exception) {
                    die($exception->getMessage());
                }
            }
        }
    }

    public function login(string $login, string $password): bool
    {
        if($this->model) return true;
        $user = UserModel::find(strtolower($login), "login");
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
        session_start();
    }

    public function directLogin(int $request_id, bool $by_request_id = true)
    {
        if($by_request_id)
            $request = UserModel::find($request_id, "request_id");
        else
            $request = UserModel::find($request_id);
        if (!is_null($request)) $this->authenticate($request);
    }
}
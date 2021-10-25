<?php

namespace Site\Controllers\User;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;
use Site\Models\UserModel;

class LoginController implements Controller
{
    function view(HttpRequest $request, $args){
        $request->show(view("cabinet.login"));
    }

    function auth(HttpRequest $request, $args){
        if(empty($request->post("login")) || empty($request->post("password"))){
            $request->setFlash("login_error", "Форма заполнена некорректно");
            $request->redirect_back();
        }
        global $auth;
        if($auth->login(strtolower($request->post("login")), $request->post("password"))) {
            $request->redirect($request->getFlash("login_redirect") ?? "/");
        } else {
            $request->setFlash("login_error", "Логин или пароль неверные");
            $request->redirect_back();
        }
    }

    function logout(HttpRequest $request, $args)
    {
        global $auth;
        $auth->logout();
        $request->redirect("/login");
    }

    function tokenAuth(HttpRequest $request, $args)
    {
        $user_id = (int) explode(":", base64_decode($args[0]))[0];
        $token = explode(":", base64_decode($args[0]))[1];
        if(!is_null($user_id) && $user_id > 0 && !is_null($token)){
            global $auth;
            $auth->logout();
            $user = UserModel::find($user_id);
            if(!is_null($user)){
                $user_token = md5($user->login.":".$user->password);
                if($token == $user_token){
                    $auth->directLogin($user_id, false);
                    $request->redirect("/" . (empty($args[1]) ? "/" : $args[1]));
                }
            }
        }
        $request->setFlash("login_error", "Токен быстрой авторизации недействителен");
        $request->redirect("/login");
    }
}
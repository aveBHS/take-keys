<?php

namespace Site\Controllers\User;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;

class LoginController implements Controller
{
    function view(HttpRequest $request, $args){
        $request->show(view("cabinet.login"));
    }

    function auth(HttpRequest $request, $args){
        global $auth;
        if($auth->login($request->post("login"), $request->post("password"))) {
            $request->redirect($request->getFlash("login_redirect") ?? "/");
        } else {
            $request->setFlash("login_error", "Логин или пароль неверные");
            $request->redirect_back();
        }
    }
}
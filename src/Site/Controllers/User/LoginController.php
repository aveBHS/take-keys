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
        $_SESSION['id'] = 1;
        $_SESSION['name'] = $request->post("login");
        $request->redirect($request->getFlash("login_redirect") ?? "/");
    }
}
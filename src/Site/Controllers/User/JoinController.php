<?php

namespace Site\Controllers\User;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;
use Site\Models\UserModel;

class JoinController implements Controller
{
    function view(HttpRequest $request, $args){ }

    function join(HttpRequest $request, $args){
        $user = new UserModel();
        $user->login = $request->post("email");
        $user->password = md5($request->post("password"));
        $user->name = $request->post("name");
        $user->type = $request->post("rentbuy");
    }
}
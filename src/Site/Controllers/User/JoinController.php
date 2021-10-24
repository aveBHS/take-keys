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
        $user->phone = getPhone($request->post("phone"));
        $user->password = md5($request->post("password"));
        $user->name = $request->post("name");

        $request->setHeader("Content-Type", "application/json");
        if ($user->save()){
            $request->show(json_encode([
                "result"  => "OK",
                "user_id" => $user->id
            ]));
        } else {
            $request->show(json_encode([
                "result"  => "ERROR",
                "reason"  => "Телефон или почта уже заняты"
            ]));
        }
    }
}
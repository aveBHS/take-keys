<?php

namespace Site\Controllers\User;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;
use Site\Models\UserModel;

class JoinController implements Controller
{
    function view(HttpRequest $request, $args){
        $request->redirect("https://take-keys.com/tarifishe");
        // $request->show(view("cabinet.join"));
    }

    function join(HttpRequest $request, $args){
        // TODO registration logic
    }
}
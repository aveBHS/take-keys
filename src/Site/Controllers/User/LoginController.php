<?php

namespace Site\Controllers\User;

class LoginController
{
    function view($request){
        $request->show(view("cabinet.login"));
    }
}
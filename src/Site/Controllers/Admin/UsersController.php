<?php

namespace Site\Controllers\Admin;

use Site\Core\HttpRequest;
use Site\Models\LogModel;
use Site\Models\UserModel;

class UsersController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->show(view("admin.index"));
    }

    public function report(HttpRequest $request, $args)
    {
        $user = UserModel::find($args[0]);
        $logs = LogModel::select([["user_id", $user->id]]);
        $request->show(view("admin.users.report", ['user' => $user, 'logs' => $logs]));
    }
}
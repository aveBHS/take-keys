<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;

class MegafonController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args){ }

    public function request(HttpRequest $request, $args){
        $request->show(view("var_export", ["vars" => ["HttpRequest" => $request, "Args" => $args]]));
        file_put_contents("crm.txt", var_export($request, true));
    }
}
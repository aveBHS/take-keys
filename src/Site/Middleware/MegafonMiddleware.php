<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

class MegafonMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        if($request->post('token') == env("megafon_token")){
            return call_user_func_array($callback, $args);
        } else {
            $request->returnException(new \Site\Controllers\Exceptions\BadRequestController, 400);
        }
    }
}
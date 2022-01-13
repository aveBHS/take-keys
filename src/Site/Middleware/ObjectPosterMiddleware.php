<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

class ObjectPosterMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        if($request->post('token') == env("poster_token") || $request->get("token") == env("poster_token")){
            return call_user_func_array($callback, $args);
        } else {
            $request->returnException(new \Site\Controllers\Exceptions\ForbiddenController(), 403);
        }
    }
}
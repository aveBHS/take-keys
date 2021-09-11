<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

class GuestMiddleware implements Middleware
{
    public function handle(HttpRequest $request, $callback, $args)
    {
        if(!isset($_SESSION['id']))
            return call_user_func_array($callback, $args);
        $request->redirect("/");
        return null;
    }
}
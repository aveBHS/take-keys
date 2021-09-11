<?php

namespace Site\Middleware;

class GuestMiddleware implements Middleware
{
    public function handle($callback, $args)
    {
        return call_user_func_array($callback, $args);
    }
}
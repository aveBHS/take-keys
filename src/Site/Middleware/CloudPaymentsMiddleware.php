<?php

namespace Site\Middleware;

use Site\Controllers\Exceptions\ForbiddenController;
use Site\Core\HttpRequest;

class CloudPaymentsMiddleware implements Middleware
{

    public function handle(HttpRequest $request, $callback, $args)
    {
        $hash = hash_hmac('sha256', $request->body, env("cloudpayments_token"), true);
        $hash = base64_encode($hash);
        if($hash == $request->getHeader("Content-HMAC") || $hash == $request->getHeader("X-Content-HMAC")){
            return call_user_func_array($callback, $args);
        } else {
            $request->returnException(new ForbiddenController(), 403);
        }
        return null;
    }
}
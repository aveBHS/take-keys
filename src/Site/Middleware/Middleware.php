<?php

namespace Site\Middleware;

use Site\Core\HttpRequest;

interface Middleware
{
    public function handle(HttpRequest $request, $callback, $args);
}
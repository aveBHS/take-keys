<?php

namespace Site\Middleware;

interface Middleware
{
    public function handle($callback, $args);
}
<?php

namespace Site\Controllers;

use Site\Core\HttpRequest;

interface Controller
{
    public function view(HttpRequest $request, $args);
}
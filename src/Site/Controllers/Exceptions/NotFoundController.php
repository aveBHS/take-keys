<?php

namespace Site\Controllers\Exceptions;

class NotFoundController
{
    public function view(): string
    {
        return "404 Not Found";
    }
}
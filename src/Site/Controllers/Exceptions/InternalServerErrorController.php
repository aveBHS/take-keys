<?php

namespace Site\Controllers\Exceptions;

class InternalServerErrorController
{
    public function view(): string
    {
        return "500 Internal Server Error";
    }
}
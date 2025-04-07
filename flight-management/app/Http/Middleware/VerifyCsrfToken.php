<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken extends Middleware
{
    protected $except = [];
}

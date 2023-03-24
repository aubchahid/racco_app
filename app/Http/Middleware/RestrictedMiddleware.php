<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictedMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        abort_if(Auth::user()->roles->first()->name != $role, 403, 'Unauthorized action.');

        return $next($request);
    }
}

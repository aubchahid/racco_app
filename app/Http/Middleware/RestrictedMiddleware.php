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
        if (Auth::user()->roles->first()->name != $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

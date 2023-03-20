<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Services\web\LoginService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return LoginService::redirectToHomePage(Auth::user()->roles->first()->name);
        }

        return $next($request);
    }
}

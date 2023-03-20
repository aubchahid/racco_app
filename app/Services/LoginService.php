<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class LoginService
{
    static public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], true)) {
            switch (Auth::user()->roles->first()->name) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    break;
                default:
                    return redirect()->route('login');
                    break;
            }
        }
    }

    static public function redirectToHomePage($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }

    static public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

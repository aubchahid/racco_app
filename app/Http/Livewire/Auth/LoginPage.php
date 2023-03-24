<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Services\web\LoginService;
use Livewire\Component;

class LoginPage extends Component
{

    public $email, $password;

    public function login(){
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->addError('error', 'Erreur ! veuillez vérifier votre e-mail et votre mot de passe.');

        LoginService::login($this->email, $this->password);    
    }
    
    public function render()
    {
        return view('livewire.auth.login-page')->layout('layouts.auth', [
            'title' => 'Login',
        ]);
    }
}

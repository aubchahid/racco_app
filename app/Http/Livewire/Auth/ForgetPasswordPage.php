<?php

namespace App\Http\Livewire\Auth;

use App\Services\web\LoginService;
use Livewire\Component;

class ForgetPasswordPage extends Component
{
    public $email;

    public function resetPassword()
    {
        $this->validate(
            [
                'email' => 'required|email|exists:users,email'
            ],
            [
                'email.required' => 'Veuillez saisir votre adresse email',
                'email.email' => 'Veuillez saisir une adresse email valide',
                'email.exists' => 'Cette adresse email n\'existe pas',
            ]
        );

        LoginService::sendResetPasswordEmail($this->email);
    }

    public function render()
    {
        return view('livewire.auth.forget-password-page')->layout('layouts.auth', ['title' => 'Mot de passe oublié']);
    }
}

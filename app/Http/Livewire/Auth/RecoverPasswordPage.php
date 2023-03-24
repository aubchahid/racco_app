<?php

namespace App\Http\Livewire\Auth;

use App\Services\web\LoginService;
use Illuminate\Http\Request;
use Livewire\Component;

class RecoverPasswordPage extends Component
{
    public $password, $confirmed,$email;

    public function resetPassword(Request $request)
    {
        $this->validate(
            [
                'password' => 'required|min:8',
                'confirmed' => 'required|same:password',
            ],
            [
                'password.required' => 'Le mot de passe est requis',
                'confirmed.same' => 'Les mots de passe ne correspondent pas',
                'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
                'confirmed.required' => 'La confirmation du mot de passe est requise',
            ],
        );

        $data = [
            'email' => $this->email,
            'password' => $this->confirmed,
        ];

        LoginService::resetPassword($data);
    }

    public function mount(Request $request)
    {
        $this->email = $request->email;
    }

    public function render()
    {
        return view('livewire.auth.recover-password-page')->layout('layouts.auth', ['title' => 'Réinitialiser le mot de passe']);
    }
}

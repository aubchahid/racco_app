<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class CheckYourEmailPage extends Component
{
    public function render()
    {
        return view('livewire.auth.check-your-email-page')->layout('layouts.auth', ['title' => 'Vérifiez votre email']);
    }
}

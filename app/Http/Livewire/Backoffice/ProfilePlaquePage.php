<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Plaque;
use Livewire\Component;

class ProfilePlaquePage extends Component
{

    public $plaque;

    public function mount(Plaque $plaque)
    {
        $this->plaque = $plaque;
    }

    public function render()
    {
        return view('livewire.backoffice.profile-plaque-page')->layout('layouts.app', [
            'title' => 'Profile Plaque',
        ]);
    }
}

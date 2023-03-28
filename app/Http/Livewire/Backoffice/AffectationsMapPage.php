<?php

namespace App\Http\Livewire\Backoffice;

use Livewire\Component;

class AffectationsMapPage extends Component
{
    public function render()
    {
        return view('livewire.backoffice.affectations-map-page')->layout('layouts.app', [
            'title' => 'Affectations Map',
        ]);
    }
}

<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class MapComponent extends Component
{
    public function initializeMap()
    {
        $this->dispatchBrowserEvent('initializeMap', [
            'lat' => 51.505,
            'lng' => -0.09,
            'zoom' => 13,
        ]);
    }

    public function render()
    {
        return view('livewire.components.map-component');
    }
}

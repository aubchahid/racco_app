<?php

namespace App\Http\Livewire\Backoffice;

use App\Services\web\TechniciensService;
use Livewire\Component;

class TechnicienPage extends Component
{
    public function render()
    {
        $techniciens = TechniciensService::returnTechniciens();
        return view('livewire.backoffice.technicien-page',compact('techniciens'))->layout('layouts.app',['title' => 'Techniciens']);
    }
}

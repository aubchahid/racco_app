<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Soustraitant;
use App\Services\web\SoustraitantService;
use Livewire\Component;

class ProfileSoustraitantPage extends Component
{
    public $soustraitant,$start_date,$end_date,$data;

    public function mount(Soustraitant $soustraitant)
    {
        $this->soustraitant = $soustraitant;
    }

    public function search()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $this->data = SoustraitantService::KpisSoustraitant([$this->start_date,$this->end_date]);
    }

    public function render()
    {
        $this->data = SoustraitantService::KpisSoustraitant([$this->start_date. ' 00:00:00',$this->end_date.' 23:59:59']);
        return view('livewire.backoffice.profile-soustraitant-page')->layout('layouts.app', [
            'title' => $this->soustraitant->name,
        ]);
    }
}

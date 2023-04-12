<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Soustraitant;
use App\Services\web\SoustraitantService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileSoustraitantPage extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $soustraitant,$start_date,$end_date,$clients;

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

        $this->clients = SoustraitantService::returnClientSoustraitant([Carbon::parse($this->start_date)->startOfDay(),Carbon::parse($this->end_date)->endOfDay()],$this->soustraitant->id);
    }

    public function render()
    {
        $this->clients = SoustraitantService::returnClientSoustraitant([Carbon::parse($this->start_date)->startOfDay(),Carbon::parse($this->end_date)->endOfDay()],$this->soustraitant->id);
        return view('livewire.backoffice.profile-soustraitant-page')->layout('layouts.app', [
            'title' => $this->soustraitant->name,
        ]);
    }
}

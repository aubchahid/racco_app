<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Plaque;
use Livewire\Component;
use Livewire\WithPagination;

class PlaquesPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $status, $plaque_name = "";

    public function render()
    {
        $plaques = Plaque::with(['city', 'clients', 'techniciens'])
            ->when($this->status != "", function ($query) {
                $query->where('status', $this->status);
            })
            ->where('code_plaque', 'LIKE', '%' . $this->plaque_name . '%')
            ->paginate(25);

        return view('livewire.backoffice.plaques-page', compact('plaques'))->layout('layouts.app', [
            'title' => 'Plaques',
        ]);
    }
}

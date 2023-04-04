<?php

namespace App\Http\Livewire\Backoffice;

use App\Exports\PlaqueExport;
use App\Models\City;
use App\Models\Plaque;
use App\Models\Technicien;
use Livewire\Component;
use Livewire\WithPagination;

class PlaquesPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $status, $plaque_name = "", $plaque_id, $deleteList = [], $city, $plaque;
    public $technicien_affectation;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInputs()
    {
        $this->deleteList = [];
        $this->technicien_affectation = '';
    }

    public function add()
    {
        $this->validate([
            'plaque' => 'required',
            'city' => 'required',
        ]);

        Plaque::create([
            'code_plaque' => $this->plaque,
            'city_id' => $this->city,
        ]);

        $this->city = $this->plaque = '';
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Plaque ajouté avec succès.']);
    }

    public function edit()
    {
        $this->validate([
            'plaque' => 'required',
            'city' => 'required',
        ]);

        Plaque::find($this->plaque_id)->update([
            'code_plaque' => $this->plaque,
            'city_id' => $this->city,
        ]);

        $this->city = $this->plaque = '';
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Plaque modifié avec succès.']);
    }

    public function setPlaque(Plaque $plaque)
    {
        $this->plaque_id = $plaque->id;
        $this->plaque = $plaque->code_plaque;
        $this->city = $plaque->city_id;
    }

    public function delete()
    {
        Plaque::find($this->plaque_id)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Plaque supprimé avec succès.']);
    }

    public function deleteAll()
    {
        foreach ($this->deleteList as $item) {
            Plaque::find($item)->delete();
        }
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Plaques supprimés avec succès.']);
        $this->resetInputs();
    }

    public function affectation()
    {
        $this->validate([
            'technicien_affectation' => 'required',
        ]);

        Technicien::find($this->technicien_affectation)->plaques()->syncWithoutDetaching($this->deleteList);
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Plaques affectés avec succès.']);
        $this->resetInputs();
    }

    public function export()
    {
        return (new PlaqueExport())->download('Plaques_' . now()->format('d_m_Y_H_i_s') . '.xlsx');
        $this->emit('success');
    }

    public function render()
    {
        $plaques = Plaque::with(['city', 'clients', 'techniciens'])
            ->when($this->status != "", function ($query) {
                $query->where('status', $this->status);
            })
            ->where('code_plaque', 'LIKE', '%' . $this->plaque_name . '%')
            ->paginate(25);

        $techniciens = Technicien::with('user')->get();
        $cities = City::get(['name', 'id']);
        return view('livewire.backoffice.plaques-page', compact('plaques', 'techniciens', 'cities'))->layout('layouts.app', [
            'title' => 'Plaques',
        ]);
    }
}

<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CitiesPage extends Component
{
    use WithPagination;
    public $search = '', $city_id, $city_name, $edit_city_name;

    public function add()
    {
        $this->validate([
            'city_name' => 'required',
        ]);

        City::create([
            'uuid' => Str::uuid(),
            'name' => $this->city_name,
        ]);

        $this->city_name = '';
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Ville ajouté avec succès.']);
    }

    public function setCity(City $city)
    {
        $this->city_id = $city->id;
        $this->edit_city_name = $city->name;
    }

    public function edit()
    {
        $this->validate([
            'edit_city_name' => 'required',
        ]);

        City::find($this->city_id)->update([
            'name' => $this->edit_city_name,
        ]);

        $this->city_name = '';
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Ville modifié avec succès.']);
    }

    public function delete()
    {
        City::find($this->city_id)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Ville supprimé avec succès.']);
    }

    public function render()
    {
        $cities = City::withCount(['plaques', 'clients'])->where('name', 'LIKE', '%' . $this->search . '%')->paginate(15);
        return view('livewire.backoffice.cities-page', compact('cities'))->layout('layouts.app', [
            'title' => 'Villes',
        ]);
    }
}

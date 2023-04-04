<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Soustraitant;
use Livewire\Component;
use Illuminate\Support\Str;

class SoustraitantPage extends Component
{

    public $name,$soustraitant_name;


    public function add(){
        $this->validate([
            'soustraitant_name' => 'required',
        ]);

        Soustraitant::create([
            'uuid' => Str::uuid(),
            'name' => $this->soustraitant_name,
        ]);

        $this->soustraitant_name = '';
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Soustraitant ajouté avec succès.']);
    }

    public function render()
    {
        $soustraitant = Soustraitant::withCount(['techniciens','clients'])->where('name','LIKE','%'.$this->name.'%')->get();
        return view('livewire.backoffice.soustraitant-page',compact('soustraitant'))->layout('layouts.app', [
            'title' => 'Soustraitant',
        ]);
    }
}

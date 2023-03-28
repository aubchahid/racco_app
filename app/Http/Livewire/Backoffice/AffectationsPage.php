<?php

namespace App\Http\Livewire\Backoffice;

use App\Exports\AffectationExport;
use App\Models\Affectation;
use App\Models\Technicien;
use App\Services\web\AffectationsService;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AffectationsPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $start_date,$end_date,$client_name,$client_sip,$client_status,$technicien;
    public $affectation_id,$deleteList = [];
    public $technicien_affectation, $cause;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function export()
    {
        $this->emit('success');
        return (new AffectationExport($this->client_name, $this->client_sip, $this->client_status, $this->technicien, $this->start_date, $this->end_date))->download('Affectation_' . now()->format('d_m_Y_H_i_s') . '.xlsx');
    }

    public function delete()
    {
        Affectation::find($this->affectation_id)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Affectation supprimé avec succès.']);
    }

    public function deleteAll()
    {
        foreach ($this->deleteList as $item) {
            Affectation::find($item)->delete();
        }
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Affectations supprimés avec succès.']);
    }

    public function affectation()
    {
        $this->validate([
            'technicien_affectation' => 'required',
        ]);

        foreach ($this->deleteList as $item) {
            Affectation::find($item)->update([
                'technicien_id' => $this->technicien_affectation,
                'status' => 'En cours',
            ]);
        }
        $this->deleteList = [];
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Client affecté avec succès.']);
    }

    public function render()
    {
        $affectations = AffectationsService::getAffectations($this->client_name,$this->client_sip,$this->client_status,$this->technicien,$this->start_date,$this->end_date)->paginate(10);
        $data = AffectationsService::getAffectationsStatistic();
        $techniciens = Technicien::with('user')->get();

        return view('livewire.backoffice.affectations-page',compact('data','techniciens','affectations'))->layout('layouts.app', [
            'title' => 'Affectations',
        ]);
    }
}

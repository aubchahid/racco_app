<?php

namespace App\Http\Livewire\Backoffice;

use App\Exports\RouteurExport;
use App\Imports\RouteursImport;
use App\Models\Routeur;
use App\Services\web\RouteursService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class RouteursPage extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $sn_gpon, $sn_mac, $selectedItems = [], $file, $routeur_id;
    public $client_sip, $client_name, $routeur_status, $start_date, $end_date;

    public function add()
    {
        $this->validate([
            'sn_gpon' => 'required',
            'sn_mac' => 'required',
        ]);

        Routeur::create([
            'uuid' => Str::uuid(),
            'sn_gpon' => $this->sn_gpon,
            'sn_mac' => $this->sn_mac,
        ]);

        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Routeur ajouté avec succès.']);
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new RouteursImport, $this->file);

        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Routeurs importés avec succès.']);
    }

    public function delete()
    {
        Routeur::find($this->routeur_id)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Routeur supprimé avec succès.']);
    }

    public function deleteSelected()
    {
        Routeur::whereIn('id', $this->selectedItems)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Routeurs supprimés avec succès.']);
    }

    public function export()
    {
        $this->emit('success');
        return (new RouteurExport([Carbon::parse($this->start_date)->startOfDay(), Carbon::parse($this->end_date)->endOfDay()], $this->client_name, $this->client_sip, $this->routeur_status))->download('ROUTEURS_' . date('d_m_Y_H_i_s') . '.xlsx');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Routeurs exportés avec succès.']);
    }

    public function render()
    {
        $routeurs = RouteursService::returnRouteurs([Carbon::parse($this->start_date)->startOfDay(), Carbon::parse($this->end_date)->endOfDay()], $this->client_name, $this->client_sip, $this->routeur_status)->paginate(25);
        $data = RouteursService::kpisRouteurs();
        return view('livewire.backoffice.routeurs-page', compact(['routeurs', 'data']))->layout('layouts.app', ['title' => 'Routeurs']);
    }
}

<?php

namespace App\Http\Livewire\Backoffice;

use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use App\Models\Affectation;
use App\Models\AffectationHistory;
use App\Models\Client;
use App\Models\Technicien;
use App\Services\web\ClientsService;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ClientsPage extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $client_name = '', $client_sip = '', $client_status = '', $technicien = '', $start_date = '', $end_date = '';
    public $client_id = '', $selectedItems = [];
    public $fullname, $address, $debit, $sip, $phone, $file;
    public $technicien_affectation, $cause, $resetPage = false;


    public function export()
    {
        $this->emit('success');
        return (new ClientsExport($this->client_name, $this->client_sip, $this->client_status, $this->technicien, $this->start_date, $this->end_date))->download('clients_' . now()->format('d_m_Y_H_i_s') . '.xlsx');
    }

    public function delete()
    {
        Client::find($this->client_id)->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Client supprimé avec succès.']);
    }

    public function deleteAll()
    {
        Client::whereIn('id',$this->selectedItems)->delete();
        $this->selectedItems = [];
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Clients supprimés avec succès.']);
    }

    public function setClient($id)
    {
        $client = Client::find($id);
        $this->client_id = $id;
        $this->fullname = $client->name;
        $this->address = $client->address;
        $this->debit = $client->debit;
        $this->sip = $client->sip;
        $this->phone = $client->phone_no;
    }

    public function affectation()
    {
        $this->validate([
            'technicien_affectation' => 'required',
            'selectedItems' => 'required',
        ], [
            'technicien_affectation.required' => 'Veuillez choisir un technicien pour continuer.',
            'selectedItems.required' => 'Veuillez choisir au moins un client pour continuer.',
        ]);

        foreach ($this->selectedItems as $item) {
           $affectation = Affectation::updateOrCreate([
                'client_id' => $item,
                'status' => 'En cours',
            ], [
                'uuid' => Str::uuid(),
                'client_id' => $item,
                'technicien_id' => $this->technicien_affectation,
                'status' => 'En cours',
            ]);
        }
        $this->selectedItems = [];
        $this->technicien_affectation = null;
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Client affecté avec succès.']);
    }

    public function edit()
    {
        $this->validate([
            'fullname' => 'required',
            'address' => 'required',
            'debit' => 'required',
            'sip' => 'required',
            'phone' => 'required',
        ], [
            'fullname.required' => 'Le nom est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'debit.required' => 'Le débit est obligatoire',
            'sip.required' => 'Le sip est obligatoire',
            'phone.required' => 'Le téléphone est obligatoire',
        ]);

        Client::find($this->client_id)->update([
            'name' => $this->fullname,
            'address' => $this->address,
            'debit' => $this->debit,
            'sip' => $this->sip,
            'phone_no' => $this->phone,
        ]);

        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => 'Client modifié avec succès.']);
    }

    public function importManual()
    {
        $this->validate([
            'file' => 'required',
        ], [
            'file.required' => 'Le fichier est obligatoire',
        ]);

        Excel::import(new ClientsImport, $this->file);
        $this->file = null;
        $this->emit('success');
        $this->dispatchBrowserEvent('contentChanged', ['item' => ClientsImport::getNumImported().' Clients importés avec succès.']);
    }

    public function render()
    {
        $clients = ClientsService::getClients($this->client_name, $this->client_sip, $this->client_status, $this->technicien, $this->start_date, $this->end_date)->paginate(15);
        $data = ClientsService::getClientsStatistic();
        $techniciens = Technicien::with('user')->get();

        return view('livewire.backoffice.clients-page', compact(['clients', 'techniciens']), ['data' => $data])->layout('layouts.app', [
            'title' => 'Clients',
        ]);
    }
}

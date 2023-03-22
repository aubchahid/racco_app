<?php

namespace App\Http\Livewire\Backoffice;

use App\Exports\ClientsExport;
use App\Models\Client;
use App\Models\Technicien;
use App\Services\web\ClientsService;
use Livewire\Component;
use Livewire\WithPagination;


class ClientsPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $client_name = '', $client_sip = '', $client_status = '', $technicien = '', $start_date = '', $end_date = '';

    public $client_id = '',$deleteList = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(){
        $this->resetPage();
    }

    public function export()
    {
        $this->emit('success');
        return (new ClientsExport($this->client_name, $this->client_sip, $this->client_status,$this->technicien, $this->start_date, $this->end_date))->download('clients_' . now()->format('d_m_Y_H_i_s') . '.xlsx');
    }

    public function delete(){
        Client::find($this->client_id)->delete();
        $this->emit('success');
    }

    public function deleteAll(){
        foreach($this->deleteList as $item){
            Client::find($item)->delete();
        }
        $this->emit('success');
    }

    public function render()
    {
        $clients = ClientsService::getClients($this->client_name, $this->client_sip, $this->client_status,$this->technicien, $this->start_date, $this->end_date)->paginate(25);
        $data = ClientsService::getClientsStatistic();
        $techniciens = Technicien::get();

        return view('livewire.backoffice.clients-page', compact(['clients', 'techniciens']), ['data' => $data])->layout('layouts.app', [
            'title' => 'Clients',
        ]);
    }
}

<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $client_name = '', $client_sip = '', $client_status, $technicien, $start_date, $end_date;

    public function render()
    {
        $clients = Client::where('name', 'like', '%' . $this->client_name . '%')->orWhere('sip', $this->client_sip)->paginate(15);
        $allClients = Client::count();
        $clientsOfTheDay = Client::whereDate('created_at', today())->count();
        $clientsB2B = Client::where('type', 'B2B')->count();
        $clientsB2C = Client::where('type', 'B2C')->count();
        return view('livewire.backoffice.clients-page', compact(['clients', 'allClients', 'clientsOfTheDay', 'clientsB2B', 'clientsB2C']))->layout('layouts.app', [
            'title' => 'Clients',
        ]);
    }
}

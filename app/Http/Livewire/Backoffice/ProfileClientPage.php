<?php

namespace App\Http\Livewire\Backoffice;

use App\Models\Client;
use Livewire\Component;

class ProfileClientPage extends Component
{
    public $client;

    public function mount($client)
    {
        $this->client = Client::with('affectations.history.technicien.user')->find($client);
    }

    public function render()
    {
        return view('livewire.backoffice.profile-client-page')->layout('layouts.app', [
            'title' => $this->client->name,
        ]);
    }
}

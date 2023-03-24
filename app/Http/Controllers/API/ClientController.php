<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
   
   
    public function getClients()
    {

        $client =  $this->clientService->getClientApi();
        

        return response()->json(['Clients' => $client], 200);

    }

}

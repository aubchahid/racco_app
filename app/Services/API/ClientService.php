<?php

namespace App\Services\API;
use App\Models\Client;
use App\Models\Technicien;

class ClientService 
{
    public function getClientApi()
    {
        $client = Client::where("status","Saisie")->get();
        return  $client ;
    }
    

    public function getThecnincenAfectationCouteurApi($id)
    {
        $count =  Client::where("status","Saisie")->where("technicien_id",$id)->count();
        return $count; 
    }

    public function getClientThecnicienApi($id)
    {
        $clients = Client::where("technicien_id",$id)->get();
        return  $clients ;
    }
    



}

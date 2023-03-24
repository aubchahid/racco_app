<?php

namespace App\Services\API;
use App\Models\Client;
use App\Models\Technicien;

class ClientService 
{
    public function getClientApi()
    {
        $client = Client::where("status","active")->get();
        return  $client ;
    }
    

    public function getThecnincenAfectationCouteurApi($id)
    {
        $count =  Client::where("status","active")->where("thecnicien_id",$id)->count();
        return $count; 
    }



}

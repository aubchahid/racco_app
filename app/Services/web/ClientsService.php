<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Client;

class ClientsService{

    static public function getClients($client_name, $client_sip, $client_status,$technicien, $start_date, $end_date){
        $query = Client::where('name', 'like', '%'.$client_name.'%')
            ->where('sip', 'like', '%'.$client_sip.'%')
            ->where('status', 'like', '%'.$client_status.'%');
        if ($client_status != null) {
            $query->where('status', $client_status);
        }
        if ($start_date != null) {
            $query->whereBetween('created_at', [$start_date.' 00:00:00', $end_date.' 23:59:59']);
        }
        if($technicien != null){
            $query->where('technicien_id', $technicien);
        }
        return $query->orderBy('created_at', 'desc');
    }

    static public function getClientsStatistic(){
        $data = [
            'allClients' => Client::count(),
            'clientsOfTheDay' => Client::whereDate('created_at', today())->count(),
            'clientsB2B' => Client::where('type', 'B2B')->count(),
            'clientsB2C' => Client::where('type', 'B2C')->count(),
        ];
        return $data;
    }
}
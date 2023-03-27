<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\City;
use App\Models\Client;
use App\Models\Plaque;
use Carbon\Carbon;

class ClientsService
{

    static public function getClients($client_name, $client_sip, $client_status, $technicien, $start_date, $end_date)
    {
        $query = Client::with('city')->where('name', 'like', '%' . $client_name . '%')
            ->where('sip', 'like', '%' . $client_sip . '%')
            ->where('status', 'like', '%' . $client_status . '%');
        if ($client_status != null) {
            $query->where('status', $client_status);
        }
        if ($start_date != null) {
            $query->whereBetween('created_at', [Carbon::parse($start_date)->startOfDay(), Carbon::parse($end_date)->endOfDay()]);
        }
        if ($technicien != null) {
            $query->where('technicien_id', $technicien);
        }
        return $query->orderBy('created_at', 'desc');
    }

    static public function getClientsStatistic()
    {
        $clients = Client::query();
        $data = [
            'allClients' => $clients->count(),
            'clientsOfTheDay' => $clients->whereDate('created_at', today())->count(),
            'clientsB2B' => $clients->where('type', 'B2B')->count(),
            'clientsB2C' => $clients->where('type', 'B2C')->count(),
        ];
        return $data;
    }

    static public function importsClients($content)
    {
        preg_match('/Adresse d�installation\s*:\s*(.*)/', $content, $client_address);
        preg_match('/Client\s*:\s*(\D*)Contact/', $content, $client_fullname);
        preg_match('/Offre\s*:\s*(\d*)/', $content, $client_debit);
        preg_match('/Login SIP\s*:\s*(\d*)/', $content, $client_sip);
        preg_match('/Contact Client\s*:\s*(\d*)/', $content, $client_phone);
        preg_match('/CODE\s*(.{7})/', $content, $plaque);
        preg_match('/CODE\s*(.{2})/', $content, $city);

        dd($plaque);

       /*  $city_id = City::where('code', $city[1])->first();
        $plaque_id = Plaque::where('code_plaque', $plaque[1])->first();

        $data = [
            'name' => $client_fullname[1],
            'address' => $client_address[1],
            'debit' => $client_debit[1],
            'lat' => $client_lat[1],
            'lng' => $client_lng[1],
            'sip' => $client_sip[1],
            'plaque' => $plaque_id->id,
            'city' => $city_id->id,
            'phone' => $client_phone[1],
        ];
        return $data; */
    }
}

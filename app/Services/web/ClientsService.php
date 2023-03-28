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
        return Client::with(['technicien.user','city'])
        ->where(function ($q) use ($client_name) {
            $q->where('name', 'like', '%' . $client_name . '%');
        })
        ->where(function ($q) use ($client_sip) {
            $q->where('sip', 'like', '%' . $client_sip . '%');
        })
        ->when($client_status, function ($q, $client_status) {
            $q->where('status', $client_status);
        })
        ->when($start_date && $end_date, function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [Carbon::parse($start_date)->startOfDay(), Carbon::parse($end_date)->endOfDay()]);
        })
        ->when($technicien, function ($q, $technicien) {
            $q->where('technicien_id', $technicien);
        })
        ->orderByDesc('created_at');
    }

    static public function getClientsStatistic()
    {
        $clients = Client::query();
        return [
            'allClients' => $clients->count(),
            'clientsOfTheDay' => $clients->whereDate('created_at', today())->count(),
            'clientsB2B' => $clients->where('type', 'B2B')->count(),
            'clientsB2C' => $clients->where('type', 'B2C')->count(),
        ];
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


        $plaque = Plaque::where('code_plaque', $plaque[1])->first();

        return [
            'name' => $client_fullname[1],
            'address' => $client_address[1],
            'debit' => $client_debit[1],
            'lat' => 0,
            'lng' => 0,
            'sip' => $client_sip[1],
            'plaque' => $plaque->id,
            'city' => $plaque->city->id,
            'phone' => $client_phone[1],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Client;
use App\Models\Soustraitant;
use Carbon\Carbon;

class SoustraitantService
{

    static public function KpisSoustraitant($date, $id): array
    {
        $clients = Client::whereHas('technicien.soustraitant', function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->whereBetween('created_at',[Carbon::parse(now())->startOfDay(),Carbon::parse(now())->endOfDay()])
        ->get();

        return [
            'clients' => $clients->count(),
            'affectations' => 16,
            'declarations' => 17,
            'blocages' => 18,
        ];
    }

    static public function returnClientSoustraitant($date,$id)
    {
        return Client::whereHas('technicien.soustraitant', function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->whereBetween('created_at',$date)
        ->get();
    }

}

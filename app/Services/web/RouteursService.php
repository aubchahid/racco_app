<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Routeur;
use App\Models\Soustraitant;
use Carbon\Carbon;

class RouteursService
{
    public static function returnRouteurs($date, $client_name,$client_sip,$status)
    {
        return Routeur::with(['client', 'technicien'])
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->when($client_name, function ($query, $client_name) {
                return $query->whereHas('client', function ($query) use ($client_name) {
                    return $query->where('name', 'like', '%' . $client_name . '%');
                });
            })->when($client_sip, function ($query, $client_sip) {
                return $query->whereHas('client', function ($query) use ($client_sip) {
                    return $query->where('sip', 'like', '%' . $client_sip . '%');
                });
            })->orderBy('created_at', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public static function kpisRouteurs(){
        return [
            'total' => Routeur::count(),
            'total_active' => Routeur::where('status', 1)->count(),
            'total_inactive' => Routeur::where('status', 0)->count(),
            'total_need_verification' => Routeur::where('status', 2)->count(),
        ];
    }
}

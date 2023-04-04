<?php


declare(strict_types=1);

namespace App\Services\web;

use App\Models\Affectation;
use App\Models\Client;
use Carbon\Carbon;

class AffectationsService
{

    public static function getAffectations($client_name, $client_sip, $client_status, $technicien, $start_date, $end_date)
    {
        return Affectation::with(['client','client.city', 'technicien.user'])
            ->where(function ($q) use ($client_name) {
                $q->whereHas('client', function ($q) use ($client_name) {
                    $q->where('name', 'like', '%' . $client_name . '%');
                });
            })
            ->where(function ($q) use ($client_sip) {
                $q->whereHas('client', function ($q) use ($client_sip) {
                    $q->where('sip', 'like', '%' . $client_sip . '%');
                });
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



    public static function getAffectationsStatistic(): array
    {
        return [
            'affectations' => Affectation::with('client')->get(),
            'affectationsOfTheDay' => Affectation::whereDate('created_at', today())->count(),
            'totalAffectations' => Affectation::count(),
            'totalDeclaration' => Affectation::where('status', 'Declare')->count(),
            'totalNoAffecte' => Client::where('status', 'Saisie')->count(),
        ];
    }

    public static function attachUnique()
    {


    }
}

<?php

namespace App\Exports;

use App\Models\Routeur;
use App\Services\web\RouteursService;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class RouteurExport implements WithHeadings,WithStyles,WithColumnWidths
{
    use Exportable;

    protected $date,$client_name,$client_sip,$status;

    public function __construct($date,$client_name,$client_sip,$status)
    {
        $this->date = $date;
        $this->client_name = $client_name;
        $this->client_sip = $client_sip;
        $this->status = $status;
    }

    public function collection()
    {
        return RouteursService::returnRouteurs($this->date,$this->client_name,$this->client_sip,$this->status)->get();
    }

    public function headings(): array
    {
        return [
            'SN_GPON',
            'SN_MAC',
            'SIP',
            'Client',
            'Technicien',
            'Status',
        ];
    }

    public function map($routeur) : array
    {
        return [
            $routeur->sn_gpon,
            $routeur->sn_mac,
            $routeur->client->sip,
            $routeur->client->name,
            $routeur->technicien->name,
            $routeur->status == 0 ? 'Inactif' : ($routeur->status == 1 ? 'Actif' : 'Besoin de vérification'),
        ];
    }

    public function styles($sheet) : array
    {
        return [
            'A:F' => ['font' => ['size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 25,
        ];
    }
}

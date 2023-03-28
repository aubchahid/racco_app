<?php

namespace App\Exports;

use App\Services\web\AffectationsService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\Exportable;

class AffectationExport implements FromCollection, WithHeadings, withMapping, WithStyles, WithColumnWidths
{
    use Exportable;

    protected $client_name, $client_sip, $client_status, $technicien, $start_date, $end_date;

    public function __construct($client_name, $client_sip, $client_status, $technicien, $start_date, $end_date)
    {
        $this->client_name = $client_name;
        $this->client_sip = $client_sip;
        $this->client_status = $client_status;
        $this->technicien = $technicien;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function headings(): array
    {
        return [
            'SIP',
            'Nom de client',
            'Technicien',
            'Adresse',
            'Ville',
            'Numero de telephone',
            'Type',
            'Status',
            'Date de création',
        ];
    }

    public function collection()
    {
        return AffectationsService::getAffectations($this->client_name,$this->client_sip,$this->client_status,$this->technicien,$this->start_date,$this->end_date)->get();
    }

    public function map($affectation): array
    {
        return [
            $affectation->client->sip,
            $affectation->client->name,
            $affectation->technicien->user->getFullname(),
            $affectation->client->address,
            $affectation->client->city->name,
            $affectation->client->phone_no,
            $affectation->client->type,
            $affectation->status,
            $affectation->created_at,
        ];
    }

    public function styles($sheet)
    {
        return [
            'A:H' => ['font' => ['size' => 12]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 25,
            'C' => 25,
            'D' => 70,
            'E' => 20,
            'F' => 15,
            'G' => 15,
            'H' => 25,
        ];
    }
}

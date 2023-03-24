<?php

namespace App\Exports;

use App\Models\Client;
use App\Services\web\ClientsService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class ClientsFiltrage implements FromCollection, WithHeadings, withMapping, WithStyles, WithColumnWidths,WithTitle
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
        return ClientsService::getClients($this->client_name, $this->client_sip, $this->client_status,$this->technicien, $this->start_date, $this->end_date)->get();
    }
   
    public function map($client): array
    {
        return [
            $client->sip,
            $client->name,
            $client->address,
            $client->city_name,
            $client->phone_no,
            $client->type,
            $client->status,
            $client->created_at,
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
            'C' => 50,
            'D' => 25,
            'E' => 20,
            'F' => 15,
            'G' => 15,
            'H' => 25,
        ];
    }

    public function title(): string
    {
        switch ($this->client_status) {
            case 'Saisie':
                return 'Nouveaux clients';
                break;
            case 'Blocage':
                return 'Clients bloqués';
                break;
            default:
                return 'Tous les clients';
                break;
        }
    }
}

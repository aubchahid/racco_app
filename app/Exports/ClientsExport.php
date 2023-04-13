<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClientsExport implements WithMultipleSheets
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

    public function sheets(): array
    {
        $sheets = [
            'CANVA_'.now() => new CanvaExport(),
            'Tous les clients' => new ClientsFiltrage($this->client_name, $this->client_sip, $this->client_status, $this->technicien, $this->start_date, $this->end_date),
            'Clients bloqués' => new ClientsFiltrage($this->client_name, $this->client_sip, 'Blocage', $this->technicien, $this->start_date, $this->end_date),
            'Nouveaux clients' => new ClientsFiltrage($this->client_name, $this->client_sip, 'Saisie', $this->technicien, $this->start_date, $this->end_date),
        ];

        return $sheets;
    }

}

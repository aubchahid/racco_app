<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class CanvaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithEvents
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Compte SIP',
            'Login internet',
            'Nom de client',
            'Adresse',
            'Ville',
            'Numéro de téléphone',
            'Type',
            'Débit',
            'Équipe',
            "Date d'intervention",
            'Test signal',
            'Test debit',
            'SN_GPON',
            'SN_MAC',
            'Câble 1FO',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastRow = $event->sheet->getHighestRow();

                $event->sheet->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $event->sheet->getStyle('A1:O1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:O1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $event->sheet->getStyle('A1:O1')->getFill()->getStartColor()->setARGB('002060');

                $event->sheet->getStyle('A1:O'.$lastRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $event->sheet->getStyle('A1:O'.$lastRow)->getFont()->setSize(10);
                $event->sheet->getStyle('A1:O'.$lastRow)->getFont()->setName('Calibri');
                $event->sheet->getStyle('A1:O'.$lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:O'.$lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }

    public function collection()
    {
        return Client::select('sip','client_id','clients.name','address','cities.name as city_name','phone_no','type','debit','soustraitants.name as soustraitant_name')->join('cities','cities.id','=','clients.city_id')
        ->join('techniciens','techniciens.id','=','clients.technicien_id')
        ->join('soustraitants','soustraitants.id','=','techniciens.soustraitant_id')
        ->whereIn('clients.status',['Déclaré','Validée'])
        ->get();
    }

    public function title(): string
    {
        return 'CANVA_'.date('d-m-Y');
    }
}

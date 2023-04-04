<?php

namespace App\Exports;

use App\Models\Plaque;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PlaqueExport implements FromCollection,WithHeadings,WithStyles,WithColumnWidths
{
    use Exportable;

    public function collection()
    {
        return Plaque::all();
    }

    public function headings(): array
    {
        return [
            'plaque',
            'Ville',
            'Client',
            'Technicien',
            'Status',
            'Date de création',
        ];
    }

    public function map($plaque) : array
    {
        return [
            $plaque->code_plaque,
            $plaque->city->name,
            $plaque->clients->count(),
            $plaque->techniciens->count(),
            $plaque->status,
            $plaque->created_at,
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
}

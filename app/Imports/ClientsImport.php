<?php

declare(strict_types=1);

namespace App\Imports;

use App\Enums\ClientStatusEnum;
use App\Models\Client;
use App\Services\web\ClientsService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClientsImport implements ToModel, WithStartRow
{
    use Importable;

    private static $numImported = 0;

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $data = ClientsService::importsClients($row[2]);
        //$gps = ClientsService::mapSurvey($data);
        Client::create([
            'uuid' => Str::uuid(),
            'client_id' => $data['login_internet'],
            'type' => 'B2C',
            'name' => $data['name'],
            'address' => $data['address'],
            'lat' => 0,//$gps[0],
            'lng' => 0,//$gps[1],
            'city_id' => $data['city'],
            'plaque_id' => $data['plaque'],
            'debit' => $data['debit'] == 12 ? 20 : $data['debit'],
            'sip' => $data['sip'],
            'phone_no' => $data['phone'],
            'status' => ClientStatusEnum::NEW,
            'created_by' => Auth::user()->id,
        ]);

        self::$numImported++;
    }

    public static function getNumImported()
    {
        return self::$numImported;
    }
}

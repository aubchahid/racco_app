<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Soustraitant;

class SoustraitantService
{

    static public function KpisSoustraitant($date) : array
    {
        return [
            'clients' => 15,
            'affectations' => 16,
            'declarations' => 17,
            'blocages' => 18,
        ];

    }
}

<?php


declare(strict_types=1);

namespace App\Services\web;

use App\Models\Technicien;

class TechniciensService
{

    static function returnTechniciens()
    {
        return Technicien::with('user')->get();
    }
}

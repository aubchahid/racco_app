<?php

declare(strict_types=1);

namespace App\Services\web;

use App\Models\Affectation;
use App\Models\Client;

class AdminDashboardService
{
    static public function getKpisData(){
        $data = [
            'total_new_importations' => Client::whereDate('created_at', today())->count(),
            'total_clients' => Client::count(),
            'total_affectations' => Affectation::whereDate('created_at', today())->count(),
            'total_affectations_new_client' => Affectation::whereHas('client', function($query){
                $query->whereDate('created_at', today());
            })->count(),
            'total_validations' => Client::where('status', 'validation')->count(),
            'total_blocages' => Client::where('status', 'blocage')->count(),
            'total_planification_for_today' => Affectation::whereDate('planification_date', today())->count(),
            'total_pipe' => 54,
        ];
        return $data;
    }

}
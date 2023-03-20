<?php

namespace App\Http\Livewire\Backoffice;

use App\Services\AdminDashboardService;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {   
        $kpisData = AdminDashboardService::getKpisData();
        return view('livewire.backoffice.dashboard',compact('kpisData'))->layout('layouts.app', [
            'title' => 'Dashboard',
        ]);
    }
}

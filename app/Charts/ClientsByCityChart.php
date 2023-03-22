<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ClientsByCityChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $clients = DB::table('clients')->groupBy('city_id')->join('cities','clients.city_id','=','cities.id')->selectRaw('count(*) as total, cities.name as city')->get();
        foreach ($clients as $client) {
           $cities [] = $client->city;
           $data [] = $client->total;
        }
        return $this->chart->pieChart()    
            ->addData($data ?? [])
            ->setLabels($cities ?? [])->setColors(['#45BE26','#F7B924','#F76397','#4B25BE','#BE4025']);
    }
}

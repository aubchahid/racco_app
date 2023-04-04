<?php

namespace App\Charts;

use App\Models\Blocage;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class BlocageByCityChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $results = Blocage::select('cause', DB::raw('count(*) as count'))
            ->groupBy('cause')
            ->whereDate('created_at', now())
            ->get();

        foreach ($results as $value) {
            $causes[] = $value->cause;
            $data[] = $value->count;
        }

        return $this->chart->donutChart()
            ->addData($data ?? [])
            ->setLabels($causes ?? []);
    }
}

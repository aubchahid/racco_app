<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class BlocageByCityChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()          
            ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}

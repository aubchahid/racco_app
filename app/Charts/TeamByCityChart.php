<?php

namespace App\Charts;

use App\Models\City;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TeamByCityChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Affectations', $data ?? [])
            ->setColors(['#0ACF97', '#727CF5', '#F36E89']);
    }
}

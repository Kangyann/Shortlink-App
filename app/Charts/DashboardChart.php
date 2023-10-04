<?php

namespace App\Charts;

use App\Models\Shortlink;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardChart
{
    protected $chart;
    private $data;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $allVisitor = Shortlink::all();
        $this->data = [1];
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Month', [])
            ->setHeight(240)
            ->setXAxis(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum`at', 'Sabtu', 'Minggu']);
    }
}

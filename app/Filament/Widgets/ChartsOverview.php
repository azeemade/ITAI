<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Category;
use Filament\Widgets\DoughnutChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChartsOverview extends DoughnutChartWidget
{
    protected static ?string $heading = 'Assets overview';
    protected static ?int $sort = 2;

    public function getChartLabels()
    {
        $categories = Category::get();

        return $categories->pluck('name')->toArray();
    }

    public function getChartData()
    {
        $count = Asset::groupBy('category_id')
            ->orderBy('category_id', 'DESC')
            ->get(array(
                DB::raw('COUNT(*) as "count"')
            ));

        return $count->pluck('count')->toArray();
    }

    protected function getData(): array
    {
        return [
            'labels' => $this->getChartLabels(),
            'datasets' => [
                [
                    'label' => 'My First Dataset',
                    'data' => $this->getChartData(),
                    'backgroundColor' => [
                        '#2F80ED',
                        '#219653',
                        '#EB5757',
                        '#9B51E0',
                        '#F2994A',
                        '#333333'
                    ],
                    'hoverOffset' => 4
                ]
            ]
        ];
    }
}

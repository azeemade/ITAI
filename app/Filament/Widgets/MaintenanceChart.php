<?php

namespace App\Filament\Widgets;

use App\Enums\MaintenanceStatus;
use Filament\Widgets\DoughnutChartWidget;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class MaintenanceChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Maintenance Overview';
    protected static ?int $sort = 2;

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
            'labels' => MaintenanceStatus::getKeys(),
            'datasets' => [
                [
                    'label' => 'My First Dataset',
                    'data' => [23, 12, 9],
                    'backgroundColor' => [
                        '#2F80ED',
                        '#219653',
                        '#EB5757',
                    ],
                    'hoverOffset' => 4
                ]
            ]
        ];
    }
}

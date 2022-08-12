<?php

namespace App\Filament\Resources\AssetResource\Widgets;

use App\Models\Asset;
use App\Models\Department;
use Filament\Widgets\DoughnutChartWidget;
use Illuminate\Support\Facades\DB;

class DepartmentAssetsChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Assets by Departments';
    // protected static ?int $sort = 2;
    // protected int | string | array $columnSpan = 'full';

    public function getChartLabels()
    {
        $department = Department::get();

        return $department->pluck('name')->toArray();
    }

    public function getChartData()
    {
        $count = Asset::groupBy('department_id')
            ->orderBy('department_id', 'DESC')
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
                        '#003366',
                        '#339966',
                        '#003300',
                        '#666633',
                        '#663300',
                        '#993300',
                        '#993333',
                        '#993366',
                        '#660066',
                        '#6600cc',
                        '#000066',
                        '#003399',
                        '#33cccc',
                        '#33cc33',
                        '#ffff00',
                        '#ff5050',
                        '#ff00ff',
                        '#3366ff'
                    ],
                    'hoverOffset' => 4
                ]
            ]
        ];
    }
}

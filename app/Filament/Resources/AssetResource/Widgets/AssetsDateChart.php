<?php

namespace App\Filament\Resources\AssetResource\Widgets;

use App\Models\Asset;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\DB;

class AssetsDateChart extends LineChartWidget
{
    protected static ?string $heading = 'Asset by Months';

    public function getChartData()
    {
        $assets = Asset::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $assetmcount = [];
        $assetArr = [];

        foreach ($assets as $key => $value) {
            $assetmcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($assetmcount[$i])) {
                $assetArr[date('F', mktime(0, 0, 0, $i, 1, date('Y')))] = $assetmcount[$i];
            } else {
                $assetArr[date('F', mktime(0, 0, 0, $i, 1, date('Y')))] = 0;
            }
        }

        return $assetArr;
    }

    protected function getData(): array
    {
        return [
            // 'labels' => $this->getChartLabels(),
            'datasets' => [
                [
                    'label' => 'My First Dataset',
                    'data' => $this->getChartData(),
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ]
            ]
        ];
    }
}

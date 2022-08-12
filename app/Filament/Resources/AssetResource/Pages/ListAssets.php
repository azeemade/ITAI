<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Resources\AssetResource\Widgets\DepartmentAssetsChart;
use App\Filament\Resources\AssetResource\Widgets\AssetsDateChart;

class ListAssets extends ListRecords
{
    protected static string $resource = AssetResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DepartmentAssetsChart::class,
            AssetsDateChart::class
        ];
    }
}

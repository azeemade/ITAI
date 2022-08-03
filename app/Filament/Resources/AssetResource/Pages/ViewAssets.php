<?php

namespace App\Filament\Resources\AssetResource\Pages;

use App\Filament\Resources\AssetResource;
// use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use App\Filament\Resources\AssetResource\Widgets\AssetMaintenance;
use App\Models\Asset;

class ViewAssets extends ViewRecord
{
    protected static string $resource = AssetResource::class;

    // protected static string $view = 'filament.resources.asset-resource.pages.view-assets';

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AssetMaintenance::class
        ];
    }
}

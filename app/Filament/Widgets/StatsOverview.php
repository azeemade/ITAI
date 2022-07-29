<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort =  1;

    public function allAssetsCount()
    {
        return Asset::count();
    }

    public function faultyAssetsCount()
    {
        return Asset::where('functionality', 'Faulty')->count();
    }

    public function unallocatedAssetsCount()
    {
        return Asset::where('status', 'Store')->count();
    }

    protected function getCards(): array
    {
        return [
            Card::make('All assets', $this->allAssetsCount())
                ->extraAttributes([
                    'class' => 'rounded-lg bg-red-200 shadow-md hover:shadow-lg text-gray-900
                             hover:background-[#f4eed7]',
                ]),
            Card::make('Faulty assets', $this->faultyAssetsCount())
                ->extraAttributes([
                    'class' => 'rounded-lg bg-white shadow-md hover:shadow-lg text-gray-900
                             hover:background-[#f4eed7]',
                ]),
            Card::make('Unallocated assets', $this->unallocatedAssetsCount())
                ->extraAttributes([
                    'class' => 'rounded-lg bg-white shadow-md hover:shadow-lg text-gray-900
                             hover:background-[#f4eed7]',
                ]),
        ];
    }
}

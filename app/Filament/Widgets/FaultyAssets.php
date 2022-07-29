<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use Closure;
use Filament\Tables;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class FaultyAssets extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Asset::query()->latest()->limit(10);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('name')
                ->label('Name'),
            Tables\Columns\TextColumn::make('brand')
                ->label('Brand'),
            Tables\Columns\TextColumn::make('serial_number')
                ->label('Serial number'),

            Tables\Columns\TextColumn::make('category_id')
                ->label('Category')
                ->enum(Category::all()->pluck('name', 'id')),

            Tables\Columns\TextColumn::make('department_id')
                ->label('Department')
                ->enum(Department::all()->pluck('name', 'id')),

            Tables\Columns\TextColumn::make('user_id')
                ->label('Registered by')
                ->enum(User::all()->pluck('name', 'id')),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Registered on')
                ->date(),
        ];
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function applySearchToTableQuery(Builder $query): Builder
    {
        if (filled($searchQuery = $this->getTableSearchQuery())) {
            $query->where('name', Asset::search($searchQuery)->keys())
                ->orWhere('brand', Asset::search($searchQuery)->keys());
        }

        return $query;
    }
}

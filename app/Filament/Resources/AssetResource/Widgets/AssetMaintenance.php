<?php

namespace App\Filament\Resources\AssetResource\Widgets;

use App\Models\Maintenance;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\BadgeColumn;
use App\Enums\MaintenanceStatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
use App\Models\Asset;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Collection;

class AssetMaintenance extends BaseWidget
{
    public ?Model $record = null;
    protected static ?string $heading = 'Maintenance Log';
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(?Model $record = null): Builder
    {
        $id = $this->record->id;
        $maintenance = Maintenance::where('asset_id', $id)->latest()->limit(10);
        return $maintenance;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('subject')
                ->label('Subject'),
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->extraAttributes(['class' => 'whitespace-normal']),
            BadgeColumn::make('status')
                ->label('Status')
                ->enum(MaintenanceStatus::getKeys())
                ->colors([
                    'primary' => 'Inprogress',
                    'danger' => 'Pending',
                    'success' => 'Completed',
                ]),

            BadgeColumn::make('priority')
                ->label('Priority')
                ->enum(Priority::getKeys())
                ->colors([
                    'danger' => 'Critical',
                    'warning' => 'Important',
                    'primary' => 'Normal',
                    'success' => 'Low'
                ]),

            Tables\Columns\TextColumn::make('service_type')
                ->label('Service Type')
                ->enum(ServiceType::getKeys()),

            Tables\Columns\TextColumn::make('serviced_by')
                ->label('Serviced By'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Registered on')
                ->date(),

            Tables\Columns\TextColumn::make('repaired_on')
                ->label('Repaired On')
                ->date(),
        ];
        // ->actions([
        //     Action::make('create')
        //         ->label('Create Issue')
        //         ->url(fn (Asset $record): string => route('filament.resources.maintenances.create', ['record' => $record]))
        //         ->color('primary')
        //         ->icon('heroicon-o-plus')
        // ])
    }

    protected function getTableAction(): array
    {
        return [
            Action::make('create')
                ->label('Create Issue')
                ->url(fn (Asset $record): string => route('maintenance.create', $record))
                ->color('primary')
                ->icon('heroicon-o-plus')
        ];
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function applySearchToTableQuery(Builder $query): Builder
    {
        if (filled($searchQuery = $this->getTableSearchQuery())) {
            $query->where('subject', Maintenance::search($searchQuery)->keys())
                ->orWhere('serviced_by', Maintenance::search($searchQuery)->keys());
        }

        return $query;
    }
}

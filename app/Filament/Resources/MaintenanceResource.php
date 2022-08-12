<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Filament\Resources\MaintenanceResource\RelationManagers;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use App\Enums\MaintenanceStatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\Request;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-support';

    public ?Model $record = null;
    public static function form(Form $form, ?Model $record = null): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->label('Subject')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('asset.id')
                    ->label('Asset ID')
                    ->default($record)
                    ->disabled(),

                Textarea::make('description')
                    ->label('Description')
                    ->columnSpan('full')
                    ->required(),

                Select::make('status')
                    ->required()
                    ->label('Status')
                    ->options(MaintenanceStatus::getKeys()),

                Select::make('service_type')
                    ->required()
                    ->label('Service Type')
                    ->options(ServiceType::getKeys()),

                Select::make('priority')
                    ->required()
                    ->label('Priority')
                    ->options(Priority::getKeys()),

                Forms\Components\TextInput::make('staff_id')
                    ->label('Staff ID')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('repaired_on')
                    ->label('Repaired On'),

                Forms\Components\TextInput::make('service_by')
                    ->label('Service By')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('comment')
                    ->label('Comment')
                    ->columnSpan('full')
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject'),
                Tables\Columns\TextColumn::make('asset_id')
                    ->label('Asset ID'),
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

                Tables\Columns\TextColumn::make('asset_id')
                    ->label('Asset ID'),

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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenances::route('/'),
            'create' => Pages\CreateMaintenance::route('/{record}/create'),
            'view' => Pages\ViewMaintenance::route('/{record}'),
            'edit' => Pages\EditMaintenance::route('/{record}/edit'),
        ];
    }
}

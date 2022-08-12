<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Enums\Disposition;
use Filament\Forms\Components\Fieldset;
use App\Enums\Functionality;
use App\Enums\Status;
use App\Models\Assets_staff;
use Filament\Forms\Components\Hidden;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;
    public ?Model $record = null;
    protected static ?string $heading = 'All assets';

    protected static ?string $navigationIcon = 'heroicon-o-desktop-computer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id')
                //     ->label('ID')
                //     ->disabled()
                //     ->default(Uuid::uuid4()->toString()),

                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('brand')
                    ->label('Brand')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('model')
                    ->label('Model')
                    ->maxLength(255),

                Forms\Components\TextInput::make('serial_number')
                    ->maxLength(255),

                // Forms\Components\TextInput::make('tag')
                //     ->label('Tag')
                //     ->maxLength(255),

                TagsInput::make('tags')->label('Tags'),

                Select::make('user_id')
                    ->required()
                    ->label('User')
                    ->options(User::all()->pluck('name', 'name')),

                Textarea::make('note')
                    ->label('Note')
                    ->columnSpan('full'),

                Select::make('location_id')
                    ->required()
                    ->label('Location')
                    ->relationship('location', 'name'),

                Select::make('department_id')
                    ->required()
                    ->label('Department')
                    ->relationship('department', 'name'),

                Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->relationship('category', 'name'),

                Select::make('disposition')
                    ->required()
                    ->label('Dispositon')
                    ->options(Disposition::getKeys()),

                Select::make('status')
                    ->required()
                    ->label('Status')
                    ->options(Status::getKeys()),

                Select::make('functionality')
                    ->required()
                    ->label('Functionality')
                    ->options(Functionality::getKeys()),

                KeyValue::make('others')
                    ->label('Others'),

                KeyValue::make('staff')
                    ->label('Assign to staff')
                    ->keyLabel('Staff ID')
                    ->valueLabel('Staff Name'),

                FileUpload::make('image')
                    ->label('Image'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
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

                BadgeColumn::make('status')
                    ->enum(Status::getKeys())
                    ->colors([
                        'primary' => 'Store',
                        'danger' => 'Faulty',
                        'warning' => 'With_repairs',
                        'success' => 'Issued',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered on')
                    ->date(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id')),
                SelectFilter::make('department')
                    ->label('Department')
                    ->options(Department::all()->pluck('name', 'id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Action::make('create')
                    ->label('Create Issue')
                    ->url(fn (Asset $record): string => route('filament.resources.maintenances.create', ['record' => $record->id]))
                    // ->url(fn (Asset $record) => MaintenanceResource::getUrl('create', ['record' => $record->maintenance]))
                    ->color('primary')
                    ->icon('heroicon-o-plus')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            Widgets\AssetMaintenance::class,
            Widgets\DepartmentAssetsChart::class,
            Widgets\AssetsDateChart::class,
        ];
    }

    // public function isTableSearchable(): bool
    // {
    //     return true;
    // }

    // protected function applySearchToTableQuery(Builder $query): Builder
    // {
    //     if (filled($searchQuery = $this->getTableSearchQuery())) {
    //         $query->where('name', Asset::search($searchQuery)->keys())
    //             ->orWhere('serial_number', Asset::search($searchQuery)->keys());
    //     }

    //     return $query;
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
            'view' => Pages\ViewAssets::route('/{record}'),
        ];
    }
}

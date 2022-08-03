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
use App\Enums\Functionality;
use App\Enums\Status;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;


class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;
    public ?Model $record = null;

    protected static ?string $navigationIcon = 'heroicon-o-desktop-computer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Image'),

                Forms\Components\TextInput::make('brand')
                    ->label('Brand')
                    ->required()
                    ->maxLength(255),

                Select::make('location_id')
                    ->required()
                    ->label('Location')
                    ->relationship('location', 'name'),

                Forms\Components\TextInput::make('model')
                    ->label('Model')
                    ->maxLength(255),

                Select::make('department_id')
                    ->required()
                    ->label('Department')
                    ->relationship('department', 'name'),

                Forms\Components\TextInput::make('serial_number')
                    ->maxLength(255),

                Select::make('category_id')
                    ->required()
                    ->label('Category')
                    ->relationship('category', 'name'),

                Forms\Components\TextInput::make('tag')
                    ->label('Tag')
                    ->maxLength(255),

                Textarea::make('note')
                    ->label('Note'),

                Select::make('disposition')
                    ->required()
                    ->label('Dispositon')
                    ->options(Disposition::getKeys()),

                Select::make('user_id')
                    ->required()
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id')),

                Select::make('status')
                    ->required()
                    ->label('Status')
                    ->options(Status::getKeys()),

                Select::make('functionality')
                    ->required()
                    ->label('Functionality')
                    ->options(Functionality::getKeys()),

                KeyValue::make('others')
                    ->label('Others')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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

    public static function getWidgets(): array
    {
        return [
            Widgets\AssetMaintenance::class,
        ];
    }

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

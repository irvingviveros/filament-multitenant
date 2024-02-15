<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CareerResource\Pages;
use App\Filament\App\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;
    protected static ?string $modelLabel = 'Carrera';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre de la carrera')
                    ->required(),
                Forms\Components\TextInput::make('enrollment')
                    ->label('Matrícula')
                    ->required(),
                Forms\Components\DatePicker::make('opening_date')
                    ->label('Fecha de apertura')
                    ->required()
                    ->default(now()),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpan(3),
                Forms\Components\Select::make('status')
                    ->options([
                        'Activo' => 'Activo',
                        'Inactivo' => 'Inactivo',
                    ])
                    ->default('Activo')
                    ->label('Estatus')
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('NOMBRE')
                    ->searchable(),
                Tables\Columns\TextColumn::make('enrollment')
                    ->label('MATRÍCULA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('opening_date')
                    ->label('FECHA DE APERTURA')
                    ->date('d-M-Y'),
                Tables\Columns\TextColumn::make('status')
                    ->label('ESTATUS')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Activo' => 'success',
                        'Inactivo' => 'danger',
                        // if the status is neither "Activo" nor "Inactivo", the badge will be gray-400.
                        default => 'gray-400',
                    })
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCareers::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function shouldRegisterNavigation(): bool
    {
        // Only show this resource in the navigation if the current tenant is "universidad" or "university".
        return Filament::getTenant()->slug == 'universidad' || Filament::getTenant()->slug == 'university';
    }

}

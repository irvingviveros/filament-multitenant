<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\StudentResource\Pages;
use App\Filament\App\Resources\StudentResource\RelationManagers;
use App\Models\City;
use App\Models\State;
use App\Models\Student;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $modelLabel = 'Alumno';
    protected static ?string $slug = 'alumno';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información general')
                    ->collapsible()
                    ->columns(4)
                    ->schema([
                        Forms\Components\DatePicker::make('inscription_date')
                            ->label('Fecha de inscripción')
                            ->maxDate('today')
                            ->default(now())
                            ->required(),
                    ]),
                Section::make('Información personal')
                    ->collapsible()
                    ->columns(4)
                    ->schema([
                        TextInput::make('paternal_surname')
                            ->label('Apellido paterno')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('maternal_surname')
                            ->label('Apellido materno')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('first_name')
                            ->label('Nombre(s)')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Fecha de nacimiento')
                            ->maxDate('today')
                            ->required(),
                        TextInput::make('national_id')
                            ->label('CURP')
                            ->unique(ignoreRecord: true)
                            ->alphaNum()
                            ->minLength(18)
                            ->maxLength(18)
                            ->required(),
                        //exclusive university field
                        TextInput::make('personal_email')
                            ->label('Correo electrónico personal')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->maxLength(255),

                        //exclusive university field
                        TextInput::make('personal_phone')
                            ->label('Teléfono personal')
                            ->tel()
                            ->unique(ignoreRecord: true)
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university'),

                        Select::make('nationality')
                            ->label('Nacionalidad')
                            ->options([
                                'mexicana' => 'Mexicana',
                                'estadounidense' => 'Estadounidense',
                                'otro' => 'Otro'
                            ]),
                        Select::make('state')
                            ->options(fn (Get $get): Collection => State::query()
                                ->where('country_id', '=', '142')
                                ->pluck('name', 'id'))
                            ->label('Estado de nacimiento')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('city_id', null)),
                        Select::make('city')
                            ->options(fn (Get $get): Collection => City::query()
                                ->where('state_id', $get('state'))
                                ->pluck('name', 'id'))
                            ->label('Ciudad de nacimiento')
                            ->searchable()
                            ->preload(),
                        Select::make('sex')
                            ->label('Sexo')
                            ->options([
                                'masculino' => 'Masculino',
                                'femenino' => 'Femenino',
                                'N/A' => 'N/A'
                            ]),
                        //exclusive university field
                        TextInput::make('occupation')
                            ->label('Ocupación')
                            ->maxLength(100)
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university'),
                        //exclusive university field
                        Select::make('marital_status')
                            ->label('Estado civil')
                            ->options([
                                'soltero' => 'Soltero(a)',
                                'casado' => 'Casado(a)',
                                'divorciado' => 'Divorciado(a)',
                                'viudo' => 'Viudo(a)',
                                'N/A' => 'N/A'
                            ])
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                    ]),
                Section::make('Información personal - Domicilio')
                    ->collapsible()
                    ->columns(4)
                    ->schema([
                        TextInput::make('address')
                            ->label('Calle')
                            ->maxLength(200)
                            ->required(),
                        TextInput::make('street_number')
                            ->label('No.')
                            ->required()
                            ->numeric()
                            ->maxLength(10),
                        TextInput::make('interior_number')
                            ->label('No. interior')
                            ->numeric()
                            ->maxLength(10),
                        TextInput::make('between_streets')
                            ->label('Entre calles')
                            ->required()
                            ->maxLength(200),
                        TextInput::make('neighborhood')
                            ->label('Colonia o Fraccionamiento')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('zip')
                            ->label('Código postal')
                            ->required()
                            ->numeric()
                            ->maxLength(50),
                    ]),
                Section::make('Información personal - Salud')
                    ->collapsible()
                    ->columns(3)
                    ->schema([
                        Select::make('blood_group')
                            ->label('Grupo sanguíneo')
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'A desconocido' => 'A desconocido',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'B desconocido' => 'B desconocido',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                                'AB desconocido' => 'AB desconocido',
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'O desconocido' => 'O desconocido',
                                'Desconocido' => 'Desconocido',
                                'N/A' => 'N/A'
                            ]),
                        TextInput::make('ailments')
                            ->label('Padecimientos conocidos')
                            ->maxLength(250),
                        TextInput::make('allergies')
                            ->label('Alergias')
                            ->maxLength(250),
                    ]),

                Section::make('Información Academica')
                    ->collapsible()
                    ->columns(2)
                    ->schema([
                        TextInput::make('payment_reference')
                            ->label('Referencia de pago - Opcional'),

                        // exclusive university field
                        TextInput::make('enrollment')
                            ->label('Matrícula')
                            ->required()
                            ->alphaNum()
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university'),

                        // exclusive university field
                        Select::make('career_id')
                            ->label('Carrera a cursar')
                            ->required()
                            ->options([
                                '1' => 'Ingeniería',
                                '2' => 'Medicina'
                            ])
                            ->required(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                            ->visible(Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university'),
                        Select::make('scholarship_id')
                            ->label('Descuento (beca) - Opcional')
                            ->options([
                                '1' => 'Beca Inicial',
                                '2' => 'Beca 50% descuento',
                                '3' => 'N/A'
                            ]),
                        Select::make('status')
                            ->label('Estatus del alumno')
                            ->options([
                                '1' => 'Activo',
                                '0' => 'Inactivo'
                            ])
                            ->default('1'),
                    ]),
                Section::make('Datos del padre o tutor')
                    ->collapsible()
                    ->columns(4)
                    ->schema([
                        Select::make('guardian_id')
                            ->relationship(name: 'guardian', titleAttribute: 'first_name')
                            ->columns(4)
                            ->label('Padre o tutor')
                            ->createOptionForm([
                                TextInput::make('first_name')
                                    ->label('NOMBRE(S)')
                                    ->required(),
                                TextInput::make('paternal_surname')
                                    ->label('APELLIDO PATERNO')
                                    ->required(),
                                TextInput::make('maternal_surname')
                                    ->label('APELLIDO MATERNO'),
                                Select::make('student_relationship')
                                    ->label('PARENTESCO CON EL ALUMNO')
                                    ->options([
                                        'padre' => 'Padre',
                                        'madre' => 'Madre',
                                        'tutor' => 'Tutor',
                                        'otro' => 'Otro'
                                    ])
                                    ->required(),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('NOMBRE COMPLETO')
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_id')
                    ->label('CURP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_reference')
                    ->label('REFERENCIA DE PAGO')
                    ->searchable(),
                Tables\Columns\TextColumn::make('enrollment')
                    ->label('MATRÍCULA')
                    ->visible(fn () => Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                    ->searchable(),
                Tables\Columns\TextColumn::make('career_id')
                    ->label('CARRERA')
                    ->visible(fn () => Filament::getTenant()->slug === 'universidad' || Filament::getTenant()->slug === 'university')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('ESTATUS')
                    ->badge()
                    ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('FECHA DE INSCRIPCIÓN')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('ÚLTIMA ACTUALIZACIÓN')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalWidth('7xl'),
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
                    // ...
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

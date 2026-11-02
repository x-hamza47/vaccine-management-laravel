<?php

namespace App\Filament\Resources\Hospitals;

use App\Filament\Resources\Hospitals\Pages\ManageHospitals;
use App\Models\Hospital;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $recordTitleAttribute = 'hospital_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Login Account')
                    ->description('The account hospital staff will use to log in.')
                    ->visibleOn('create')
                    ->schema([
                        TextInput::make('name')
                            ->label('Contact Name')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->unique('users', 'email')
                            ->required(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->minLength(4)
                            ->maxLength(14)
                            ->required(),
                    ]),
                Section::make('Hospital Details')
                    ->schema([
                        TextInput::make('hospital_name')
                            ->label('Hospital Name')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('address')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('location')
                            ->maxLength(255)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hospital_name')
            ->columns([
                TextColumn::make('hospital_name')
                    ->label('Hospital')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Account')
                    ->searchable(),
                TextColumn::make('address')
                    ->limit(30),
                TextColumn::make('location')
                    ->icon('heroicon-o-map-pin')
                    ->searchable(),
                IconColumn::make('user.is_approved')
                    ->label('Approved')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('location')
                    ->options(fn() => Hospital::query()
                        ->orderBy('location')
                        ->pluck('location', 'location')
                        ->all())
                    ->searchable(),
                TernaryFilter::make('approved')
                    ->label('Account Approval')
                    ->placeholder('All')
                    ->trueLabel('Approved')
                    ->falseLabel('Not approved')
                    ->queries(
                        true: fn($query) => $query->whereHas('user', fn($q) => $q->where('is_approved', true)),
                        false: fn($query) => $query->whereHas('user', fn($q) => $q->where('is_approved', false)),
                        blank: fn($query) => $query,
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->using(fn(Hospital $record) => $record->user()->delete()),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageHospitals::route('/'),
        ];
    }
    public static function canAccess(): bool
    {
        return Gate::allows('admin-view');
    }
}

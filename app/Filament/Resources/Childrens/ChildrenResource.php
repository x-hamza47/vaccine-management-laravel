<?php

namespace App\Filament\Resources\Childrens;

use App\Filament\Resources\Childrens\Pages\ManageChildrens;
use App\Models\Children;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class ChildrenResource extends Resource
{
    protected static ?string $model = Children::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFaceSmile;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Children';

    public static function canAccess(): bool
    {
        return Gate::allows('admin-view') || Gate::allows('parent-view');
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (Gate::allows('parent-view')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Parent')
                    ->relationship(
                        'parent',
                        'name',
                        fn($query) => $query->where('role', 'parent')->where('is_approved', true)
                    )
                    ->searchable()
                    ->preload()
                    ->visible(fn() => Gate::allows('admin-view'))
                    ->required(fn() => Gate::allows('admin-view')),
                TextInput::make('name')
                    ->maxLength(60)
                    ->required(),
                DatePicker::make('dob')
                    ->label('Date of birth')
                    ->maxDate(now())
                    ->native(false)
                    ->required(),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query
                ->whereHas('parent', fn($q) => $q->where('is_approved', true))
                ->withCount([
                    'vaccinationSchedules as pending_count' => fn($q) => $q->where('status', 'pending'),
                    'vaccinationSchedules as completed_count' => fn($q) => $q->where('status', 'completed'),
                ]))
            ->defaultSort('created_at', 'desc')
            ->recordTitleAttribute('name')
            ->groups(Gate::allows('admin-view') ? [
                Group::make('parent.name')
                    ->label('Parent')
                    ->collapsible(),
            ] : [])
            ->defaultGroup(Gate::allows('admin-view') ? 'parent.name' : null)
            ->columns([
                TextColumn::make('name')
                    ->label('Child Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dob')
                    ->label('Age')
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)->diffForHumans(null, true))
                    ->tooltip(fn($record) => $record->dob->format('F j, Y'))
                    ->sortable(),
                TextColumn::make('gender')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),
                TextColumn::make('pending_count')
                    ->label('Pending')
                    ->badge()
                    ->color(fn(int $state) => $state > 0 ? 'warning' : 'gray'),
                TextColumn::make('completed_count')
                    ->label('Completed')
                    ->badge()
                    ->color(fn(int $state) => $state > 0 ? 'success' : 'gray'),
                TextColumn::make('created_at')
                    ->label('Registered On')
                    ->date('F j, Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other']),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->visible(fn() => Gate::allows('admin-view') || Gate::allows('parent-view'))
                    ->authorize(fn() => Gate::allows('admin-view') || Gate::allows('parent-view')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn() => Gate::allows('admin-view') || Gate::allows('parent-view'))
                        ->authorize(fn() => Gate::allows('admin-view') || Gate::allows('parent-view')),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageChildrens::route('/'),
        ];
    }
}

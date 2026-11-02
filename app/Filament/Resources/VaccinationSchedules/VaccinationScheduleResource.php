<?php

namespace App\Filament\Resources\VaccinationSchedules;

use App\Filament\Resources\VaccinationSchedules\Pages\ManageVaccinationSchedules;
use App\Models\Hospital;
use App\Models\VaccinationSchedule;
use App\Models\Vaccine;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VaccinationScheduleResource extends Resource
{
    protected static ?string $model = VaccinationSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Vaccination Schedules';

    protected static ?string $recordTitleAttribute = 'id';

    public static function getRecordTitle(?Model $record): ?string
    {
        return $record
            ? $record->child->name . ' - ' . $record->vaccine->name
            : null;
    }

    public static function canAccess(): bool
    {
        return Gate::allows('admin-or-hospital') || Gate::allows('parent-view');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return Gate::allows('admin-view') && $record->status === 'cancelled';
    }

    public static function canDeleteAny(): bool
    {
        return Gate::allows('admin-view');
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->with(['child.parent', 'vaccine', 'hospital']);

        if (Gate::allows('hospital-view')) {
            $query->where('hospital_id', Auth::user()->hospital?->id);
        }
        if (Gate::allows('parent-view')) {
            $query->whereHas('child', fn(Builder $q) => $q->where('user_id', Auth::id()));
        }

        return $query;
    }



    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'asc')
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('child.name')
                    ->label('Child')
                    ->weight('bold')
                    ->description(fn(VaccinationSchedule $record) => Gate::allows('parent-view') ? null : 'Parent: ' . $record->child->parent->name)
                    ->searchable(),
                TextColumn::make('child.parent.name')
                    ->label('Parent')
                    ->visible(fn() => ! Gate::allows('parent-view'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('vaccine.name')
                    ->label('Vaccine')
                    ->searchable(),
                TextColumn::make('hospital.hospital_name')
                    ->label('Hospital')
                    ->visible(fn() => Gate::allows('admin-view') || Gate::allows('parent-view')),
                TextColumn::make('date')
                    ->label('Date & time')
                    ->dateTime('F j, Y g:i A')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->state(fn(VaccinationSchedule $record) => match (true) {
                        $record->status === 'cancelled' => 'Cancelled',
                        $record->status === 'completed' => 'Completed',
                        $record->date->isPast() => 'Missed',
                        default => 'Pending',
                    })
                    ->color(fn(string $state) => match ($state) {
                        'Completed' => 'success',
                        'Missed', 'Cancelled' => 'danger',
                        default => 'warning',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(['pending' => 'Pending', 'completed' => 'Completed', 'missed' => 'Missed', 'cancelled' => 'Cancelled'])
                    ->query(fn(Builder $query, array $data) => match ($data['value']) {
                        'missed' => $query->where('status', 'pending')->where('date', '<', now()),
                        'pending' => $query->where('status', 'pending')->where('date', '>=', now()),
                        'completed' => $query->where('status', 'completed'),
                        'cancelled' => $query->where('status', 'cancelled'),
                        default => $query,
                    }),
                SelectFilter::make('vaccine_id')
                    ->label('Vaccine')
                    ->options(fn() => Vaccine::pluck('name', 'id'))
                    ->searchable(),
                SelectFilter::make('hospital_id')
                    ->label('Hospital')
                    ->options(fn() => Hospital::pluck('hospital_name', 'id'))
                    ->searchable()
                    ->visible(fn() => Gate::allows('admin-view') || Gate::allows('parent-view')),
                Filter::make('date')
                    ->schema([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query
                        ->when($data['from'], fn(Builder $q, $d) => $q->whereDate('date', '>=', $d))
                        ->when($data['until'], fn(Builder $q, $d) => $q->whereDate('date', '<=', $d))),
            ])
            ->recordActions([
                Action::make('markCompleted')
                    ->label('Mark completed')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->visible(fn(?VaccinationSchedule $record) => $record?->status === 'pending' && Gate::allows('admin-or-hospital'))
                    ->authorize(fn() => Gate::allows('admin-or-hospital'))
                    ->requiresConfirmation()
                    ->modalHeading('Mark as completed?')
                    ->action(function (VaccinationSchedule $record, Action $action) {
                        $record->update(['status' => 'completed']);
                        $action->success();
                    })
                    ->successNotificationTitle('Marked as completed'),

                Action::make('markPending')
                    ->label('Mark pending')
                    ->icon(Heroicon::OutlinedArrowUturnLeft)
                    ->color('warning')
                    ->visible(fn(?VaccinationSchedule $record) => $record?->status === 'completed' && Gate::allows('admin-or-hospital'))
                    ->authorize(fn() => Gate::allows('admin-or-hospital'))
                    ->requiresConfirmation()
                    ->modalHeading('Move back to pending?')
                    ->action(function (VaccinationSchedule $record, Action $action) {
                        $record->update(['status' => 'pending']);
                        $action->success();
                    })
                    ->successNotificationTitle('Marked as pending'),
                Action::make('cancelSchedule')
                    ->label('Cancel')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->visible(fn(?VaccinationSchedule $record) => $record?->status === 'pending' && Gate::allows('admin-or-hospital'))
                    ->authorize(fn() => Gate::allows('admin-or-hospital'))
                    ->requiresConfirmation()
                    ->modalHeading('Cancel this appointment?')
                    ->modalDescription('The parent will see it as Cancelled.')
                    ->action(function (VaccinationSchedule $record, Action $action) {
                        $record->update(['status' => 'cancelled']);
                        $action->success();
                    })
                    ->successNotificationTitle('Appointment cancelled'),
                DeleteAction::make()
                    ->visible(fn(?VaccinationSchedule $record) => $record?->status === 'cancelled' && Gate::allows('admin-view'))
                    ->authorize(fn() => Gate::allows('admin-view'))
                    ->modalHeading('Delete this schedule?')
                    ->modalDescription(fn(VaccinationSchedule $record) => 'Delete the schedule for ' . $record->child->name . ' (' . $record->vaccine->name . ')? This cannot be undone.'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulkMarkCompleted')
                        ->label('Mark selected as completed')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn() => Gate::allows('admin-or-hospital'))
                        ->authorize(fn() => Gate::allows('admin-or-hospital'))
                        ->modalHeading('Mark selected as completed?')
                        ->action(fn(Collection $records) => $records->where('status', 'pending')->each->update(['status' => 'completed']))
                        ->successNotificationTitle('Selected schedules marked as completed')
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageVaccinationSchedules::route('/'),
        ];
    }
}

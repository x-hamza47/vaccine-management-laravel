<?php

namespace App\Filament\Resources\VaccineRequests;

use App\Filament\Resources\VaccineRequests\Pages\ManageVaccineRequests;
use App\Models\Children;
use App\Models\Hospital;
use App\Models\VaccinationSchedule;
use App\Models\Vaccine;
use App\Models\VaccineRequest;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class VaccineRequestResource extends Resource
{
    protected static ?string $model = VaccineRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxArrowDown;

    protected static ?string $navigationLabel = 'Vaccine Requests';

    protected static ?string $recordTitleAttribute = 'id';

    public static function canAccess(): bool
    {
        return Gate::allows('admin-view') || Gate::allows('parent-view');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Gate::allows('parent-view')) {
            $query->whereHas('child', fn(Builder $q) => $q->where('user_id', auth()->id()));
        }

        return $query;
    }
    protected static function requestDetails(): array
    {
        return [
            TextEntry::make('child_name')->label('Child')
                ->state(fn(VaccineRequest $record) => $record->child->name),
            TextEntry::make('child_gender')->label('Gender')
                ->state(fn(VaccineRequest $record) => ucfirst($record->child->gender)),
            TextEntry::make('parent_name')->label('Parent')
                ->state(fn(VaccineRequest $record) => $record->child->parent->name),
            TextEntry::make('vaccine_name')->label('Vaccine')
                ->state(fn(VaccineRequest $record) => $record->vaccine->name),
            TextEntry::make('preferred_hospital')->label('Preferred hospital')
                ->state(fn(VaccineRequest $record) => $record->hospital?->hospital_name),
            TextEntry::make('preferred_day')->label('Preferred date')
                ->state(fn(VaccineRequest $record) => $record->preferred_date?->format('F j, Y')),
            TextEntry::make('requested_on')->label('Requested on')
                ->state(fn(VaccineRequest $record) => $record->created_at->format('F j, Y')),
            TextEntry::make('request_status')->label('Status')
                ->state(fn(VaccineRequest $record) => ucfirst($record->status))
                ->badge()
                ->color(fn(VaccineRequest $record) => match ($record->status) {
                    'approved' => 'success',
                    'rejected' => 'danger',
                    default => 'warning',
                }),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('child_id')
                    ->label('Child')
                    ->placeholder('Select a child')
                    ->native(false)
                    ->options(fn() => Children::query()
                        ->when(Gate::allows('parent-view'), fn($q) => $q->where('user_id', auth()->id()))
                        ->pluck('name', 'id'))
                    ->required(),
                Select::make('vaccine_id')
                    ->label('Vaccine')
                    ->native(false)
                    ->searchable()
                    ->options(fn() => Vaccine::where('available', true)->pluck('name', 'id'))
                    ->rules([
                        'required',
                        Rule::exists('vaccines', 'id')
                            ->where('available', true),
                    ]),
                Select::make('hospital_id')
                    ->label('Hospital')
                    ->options(fn() => Hospital::pluck('hospital_name', 'id'))
                    ->searchable()
                    ->required(),
                DatePicker::make('preferred_date')
                    ->minDate(today())
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups(! Gate::allows('admin-view') ? [] : [
                Group::make('parent')
                    ->label('Parent')
                    ->getTitleFromRecordUsing(fn(VaccineRequest $record) => $record->child->parent->name)
                    ->getKeyFromRecordUsing(fn(VaccineRequest $record) => (string) $record->child->user_id)
                    ->orderQueryUsing(fn(Builder $query, string $direction) => $query->orderBy(
                        Children::select('user_id')->whereColumn('childrens.id', 'vaccine_requests.child_id'),
                        $direction
                    ))
                    ->collapsible(),
            ])
            ->defaultGroup(Gate::allows('admin-view') ? 'parent' : null)
            ->modifyQueryUsing(fn($query) => $query->with(['child.parent', 'vaccine', 'hospital']))
            ->defaultSort('created_at', 'desc')
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('child.name')
                    ->label('Child')
                    ->weight('bold')
                    ->size('md')
                    ->description(fn(VaccineRequest $record) => \Carbon\Carbon::parse($record->child->dob)
                        ->diffForHumans(null, true) . ' old')
                    ->tooltip(fn(VaccineRequest $record) => $record->child->dob->format('F j, Y'))
                    ->searchable(),
                TextColumn::make('child.parent.name')
                    ->label('Parent')
                    ->searchable()
                    ->visible(fn() => Gate::allows('admin-view'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('vaccine.name')
                    ->label('Vaccine')
                    ->searchable(),
                TextColumn::make('hospital.hospital_name')
                    ->label('Preferred Hospital'),
                TextColumn::make('preferred_date')
                    ->label('Preferred Date')
                    ->date('F j, Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),
                TextColumn::make('created_at')
                    ->label('Requested On')
                    ->since()
                    ->tooltip(fn(VaccineRequest $record) => $record->created_at->format('F j, Y g:i A'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: !true),
            ])
            ->filters([
                SelectFilter::make('vaccine_id')
                    ->label('Vaccine')
                    ->options(fn() => Vaccine::pluck('name', 'id'))
                    ->searchable(),
                SelectFilter::make('hospital_id')
                    ->label('Preferred hospital')
                    ->options(fn() => Hospital::pluck('hospital_name', 'id'))
                    ->searchable(),
                SelectFilter::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])
                    ->query(fn(Builder $query, array $data) => $query->when(
                        $data['value'],
                        fn(Builder $q, $value) => $q->whereHas('child', fn(Builder $c) => $c->where('gender', $value))
                    )),
                Filter::make('preferred_date')
                    ->label('Preferred date')
                    ->schema([
                        DatePicker::make('from')->label('Preferred from'),
                        DatePicker::make('until')->label('Preferred until'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query
                        ->when($data['from'], fn(Builder $q, $d) => $q->whereDate('preferred_date', '>=', $d))
                        ->when($data['until'], fn(Builder $q, $d) => $q->whereDate('preferred_date', '<=', $d))),
                Filter::make('requested_on')
                    ->label('Requested on')
                    ->schema([
                        DatePicker::make('from')->label('Requested from'),
                        DatePicker::make('until')->label('Requested until'),
                    ])
                    ->query(fn(Builder $query, array $data) => $query
                        ->when($data['from'], fn(Builder $q, $d) => $q->whereDate('created_at', '>=', $d))
                        ->when($data['until'], fn(Builder $q, $d) => $q->whereDate('created_at', '<=', $d))),
            ])
            ->recordActions([

                Action::make('approve')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->visible(fn(VaccineRequest $record) => Gate::allows('admin-view') && $record->status === 'pending')
                    ->authorize(fn() => Gate::allows('admin-view'))
                    ->modalHeading('Approve request')
                    ->modalSubmitActionLabel('Approve')
                    ->fillForm(fn(VaccineRequest $record) => [
                        'hospital_id' => $record->hospital_id,
                        'date' => max(
                            $record->preferred_date?->copy()->setTime(9, 0) ?? now()->addDay()->setTime(9, 0),
                            now()->addHour()->startOfHour()
                        ),
                    ])
                    ->schema([
                        Section::make('Request details')
                            ->schema(static::requestDetails())
                            ->columns(2),
                        Select::make('hospital_id')
                            ->label('Hospital')
                            ->options(Hospital::pluck('hospital_name', 'id'))
                            ->searchable()
                            ->required(),
                        DateTimePicker::make('date')
                            ->label('Date & time')
                            ->seconds(false)
                            ->native(false)
                            ->minDate(now()->startOfMinute())
                            ->required(),
                    ])
                    ->action(function (VaccineRequest $record, array $data, Action $action) {
                        DB::transaction(function () use ($record, $data) {
                            VaccinationSchedule::create([
                                'child_id' => $record->child_id,
                                'vaccine_id' => $record->vaccine_id,
                                'hospital_id' => $data['hospital_id'],
                                'date' => $data['date'],
                                'status' => 'pending',
                            ]);

                            $record->update(['status' => 'approved']);
                        });

                        $action->success();
                    })
                    ->successNotificationTitle('Request approved and schedule created'),

                Action::make('reject')
                    ->icon(Heroicon::OutlinedXCircle)
                    ->color('danger')
                    ->visible(fn(VaccineRequest $record) => Gate::allows('admin-view') && $record->status === 'pending')
                    ->authorize(fn() => Gate::allows('admin-view'))
                    ->requiresConfirmation()
                    ->modalHeading('Reject this request?')
                    ->action(function (VaccineRequest $record, Action $action) {
                        $record->update(['status' => 'rejected']);
                        $action->success();
                    })
                    ->successNotificationTitle('Request rejected'),
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageVaccineRequests::route('/'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        if (! Gate::allows('admin-view')) {
            return null;
        }

        $count = static::getModel()::where('status', 'pending')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}

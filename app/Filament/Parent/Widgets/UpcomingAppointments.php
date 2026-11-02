<?php

namespace App\Filament\Parent\Widgets;

use App\Models\VaccinationSchedule;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class UpcomingAppointments extends TableWidget
{
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Upcoming Appointments';

    public static function canView(): bool
    {
        return Gate::allows('parent-view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                VaccinationSchedule::query()
                    ->whereHas('child', fn(Builder $q) => $q->where('user_id', auth()->id()))
                    ->where('status', 'pending')
                    ->where('date', '>=', now())
                    ->with(['child', 'vaccine', 'hospital'])
            )
            ->defaultSort('date', 'asc')
            ->paginated([5])
            ->columns([
                TextColumn::make('child.name')->label('Child'),
                TextColumn::make('vaccine.name')->label('Vaccine'),
                TextColumn::make('hospital.hospital_name')->label('Hospital'),
                TextColumn::make('date')->label('Date & time')->dateTime('F j, Y g:i A'),
            ]);
    }
}

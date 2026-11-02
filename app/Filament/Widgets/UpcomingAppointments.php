<?php

namespace App\Filament\Widgets;

use App\Models\VaccinationSchedule;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UpcomingAppointments extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Gate::allows('hospital-view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Upcoming Appointments')
            ->query(fn() => VaccinationSchedule::query()
                ->with(['child.parent', 'vaccine'])
                ->where('hospital_id', Auth::user()->hospital?->id)
                ->where('status', 'pending')
                ->where('date', '>=', now())
                ->orderBy('date')
                ->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('child.name')
                    ->label('Child')
                    ->weight('bold')
                    ->description(fn(VaccinationSchedule $record) => 'Parent: ' . $record->child->parent->name),
                TextColumn::make('vaccine.name')
                    ->label('Vaccine'),
                TextColumn::make('date')
                    ->label('Date & time')
                    ->dateTime('F j, Y g:i A'),
            ])
            ->recordActions([
                Action::make('markCompleted')
                    ->label('Mark completed')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Mark as completed?')
                    ->action(function (VaccinationSchedule $record, Action $action) {
                        abort_unless(
                            $record->hospital_id === Auth::user()->hospital?->id,
                            403
                        );

                        $record->update(['status' => 'completed']);
                        $action->success();
                    })
                    ->successNotificationTitle('Marked as completed'),
            ])
            ->emptyStateHeading('No upcoming appointments')
            ->emptyStateIcon(Heroicon::OutlinedCalendarDays);
    }
}

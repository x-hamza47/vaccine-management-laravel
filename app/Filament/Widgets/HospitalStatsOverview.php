<?php

namespace App\Filament\Widgets;

use App\Models\VaccinationSchedule;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HospitalStatsOverview extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return Gate::allows('hospital-view');
    }

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        $hospitalId = Auth::user()->hospital?->id;

        $mine = fn() => VaccinationSchedule::where('hospital_id', $hospitalId);

        return [
            Stat::make('Total Appointments', $mine()->count())
                ->icon('heroicon-o-calendar-days'),

            Stat::make('Pending Appointments', $mine()->where('status', 'pending')->count())
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('Completed Appointments', $mine()->where('status', 'completed')->count())
                ->color('success')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Completed Today', $mine()->where('status', 'completed')->whereDate('date', today())->count())
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Children;
use App\Models\Hospital;
use App\Models\User;
use App\Models\VaccinationSchedule;
use App\Models\Vaccine;
use App\Models\VaccineRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Gate;

class AdminStatsOverview extends StatsOverviewWidget
{
    public static function canView(): bool
    {
        return Gate::allows('admin-view');
    }

    protected function getColumns(): int
    {
        return 3;
    }
    protected function getStats(): array
    {
        $available = Vaccine::where('available', true)->count();
        $unavailable = Vaccine::where('available', false)->count();

        return [
            Stat::make('Total Children', Children::count())
                ->icon('heroicon-o-face-smile'),

            Stat::make('Hospitals', Hospital::count())
                ->icon('heroicon-o-building-office-2'),

            Stat::make('Vaccines', $available + $unavailable)
                ->description("{$available} available, {$unavailable} unavailable")
                ->color($unavailable > 0 ? 'warning' : 'success')
                ->icon('heroicon-o-beaker'),

            Stat::make('Pending Requests', VaccineRequest::where('status', 'pending')->count())
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('Users', User::where('is_approved', true)->count())
                ->description(User::where('is_approved', false)->count() . ' waiting for approval')
                ->color(User::where('is_approved', false)->exists() ? 'warning' : 'success')
                ->icon('heroicon-o-user-group'),
            Stat::make('Completed Today', VaccinationSchedule::where('status', 'completed')->whereDate('date', today())->count())
                ->color('success')
                ->icon('heroicon-o-check-circle'),
        ];
    }
}

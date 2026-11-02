<?php

namespace App\Filament\Parent\Widgets;

use App\Models\Children;
use App\Models\VaccinationSchedule;
use App\Models\VaccineRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Gate;

class ParentStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Gate::allows('parent-view');
    }

    protected function getStats(): array
    {
        $childIds = Children::where('user_id', auth()->id())->pluck('id');

        return [
            Stat::make('My Children', $childIds->count()),
            Stat::make('Total Requests', VaccineRequest::whereIn('child_id', $childIds)->count()),
            Stat::make('Pending Appointments', VaccinationSchedule::whereIn('child_id', $childIds)
                ->where('status', 'pending')->count()),
        ];
    }
}

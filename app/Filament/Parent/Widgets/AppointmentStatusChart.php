<?php

namespace App\Filament\Parent\Widgets;

use App\Models\VaccinationSchedule;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class AppointmentStatusChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 2;


    protected ?string $heading = 'My Appointments by Status';


    protected ?string $maxHeight = '260px';

    public static function canView(): bool
    {
        return Gate::allows('parent-view');
    }

    protected function getData(): array
    {
        $mine = fn() => VaccinationSchedule::whereHas(
            'child',
            fn(Builder $q) => $q->where('user_id', auth()->id())
        );

        return [
            'labels' => ['Upcoming', 'Completed', 'Missed', 'Cancelled'],
            'datasets' => [[
                'data' => [
                    $mine()->where('status', 'pending')->where('date', '>=', now())->count(),
                    $mine()->where('status', 'completed')->count(),
                    $mine()->where('status', 'pending')->where('date', '<', now())->count(),
                    $mine()->where('status', 'cancelled')->count(),
                ],
                'backgroundColor' => ['#F59E0B', '#22C55E', '#EF4444', '#9CA3AF'],
            ]],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['position' => 'right'],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}

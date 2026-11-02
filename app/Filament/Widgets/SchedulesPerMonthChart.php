<?php

namespace App\Filament\Widgets;

use App\Models\VaccinationSchedule;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Gate;

class SchedulesPerMonthChart extends ChartWidget
{
    protected ?string $heading = 'Schedules per Month (last 6 months)';

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '260px';

    public static function canView(): bool
    {
        return Gate::allows('admin-view');
    }

    protected function getData(): array
    {
        $start = now()->subMonths(5)->startOfMonth();

        $rows = VaccinationSchedule::selectRaw("DATE_FORMAT(date, '%Y-%m') as month, status, COUNT(*) as total")
            ->where('date', '>=', $start)
            ->groupBy('month', 'status')
            ->get();

        $months = collect(range(0, 5))->map(fn($i) => $start->copy()->addMonths($i));

        $countFor = fn(string $status) => $months->map(
            fn($m) => (int) $rows
                ->where('month', $m->format('Y-m'))
                ->where('status', $status)
                ->sum('total')
        )->all();

        return [
            'datasets' => [
                [
                    'label' => 'Completed',
                    'data' => $countFor('completed'),
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Pending',
                    'data' => $countFor('pending'),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months->map(fn($m) => $m->format('M Y'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected function getOptions(): array
    {
        return [
            'aspectRatio' => 1.1,
            'scales' => [
                'y' => ['beginAtZero' => true, 'ticks' => ['precision' => 0]],
            ],
        ];
    }
}

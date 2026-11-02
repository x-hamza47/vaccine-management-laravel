<?php

namespace App\Filament\Widgets;

use App\Models\VaccineRequest;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Gate;

class VaccineRequestsChart extends ChartWidget
{
    protected ?string $heading = 'Vaccine Requests by Status';

    protected static ?int $sort = 2;

    protected ?string $maxHeight = '260px';

    public static function canView(): bool
    {
        return Gate::allows('admin-view');
    }

    protected function getData(): array
    {
        $counts = VaccineRequest::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'data' => [
                        $counts['pending'] ?? 0,
                        $counts['approved'] ?? 0,
                        $counts['rejected'] ?? 0,
                    ],
                    'backgroundColor' => ['#f59e0b', '#22c55e', '#ef4444'],
                ],
            ],
            'labels' => ['Pending', 'Approved', 'Rejected'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
    protected function getOptions(): array
    {
        return [
            'cutout' => '65%',
        ];
    }
}

<?php

namespace App\Filament\Resources\VaccinationSchedules\Pages;

use App\Filament\Resources\VaccinationSchedules\VaccinationScheduleResource;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ManageVaccinationSchedules extends ManageRecords
{
    protected static string $resource = VaccinationScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'upcoming' => Tab::make('Upcoming')
                ->modifyQueryUsing(fn(Builder $query) => $query
                    ->where('status', 'pending')
                    ->where('date', '>=', now())),
            'history' => Tab::make('History')
                ->modifyQueryUsing(fn(Builder $query) => $query
                    ->where(fn(Builder $q) => $q
                        ->whereIn('status', ['completed', 'cancelled'])
                        ->orWhere('date', '<', now()))),
            'all' => Tab::make('All'),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'upcoming';
    }
}

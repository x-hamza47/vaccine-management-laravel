<?php

namespace App\Filament\Resources\VaccineRequests\Pages;

use App\Filament\Resources\VaccineRequests\VaccineRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class ManageVaccineRequests extends ManageRecords
{
    protected static string $resource = VaccineRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Book Appointment')
                ->visible(fn() => Gate::allows('parent-view'))
                ->authorize(fn() => Gate::allows('parent-view'))
                ->mutateDataUsing(fn(array $data) => $data + ['status' => 'pending'])
                ->successNotificationTitle('Appointment requested'),
        ];
    }
    public function getTabs(): array
    {
        return [
            'pending' => Tab::make('Pending')
                ->badge(fn() => static::getResource()::getEloquentQuery()->where('status', 'pending')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending')),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'approved')),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'rejected')),
            'all' => Tab::make('All'),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'pending';
    }
}

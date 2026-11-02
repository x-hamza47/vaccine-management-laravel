<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\VaccineRequests\VaccineRequestResource;
use App\Models\VaccineRequest;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Gate;

class RecentVaccineRequests extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Gate::allows('admin-view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Pending Requests')
            ->query(fn () => VaccineRequest::query()
                ->with(['child.parent', 'vaccine', 'hospital'])
                ->where('status', 'pending')
                ->latest()
                ->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('child.name')
                    ->label('Child')
                    ->weight('bold')
                    ->description(fn (VaccineRequest $record) => 'Parent: ' . $record->child->parent->name),
                TextColumn::make('vaccine.name')
                    ->label('Vaccine'),
                TextColumn::make('hospital.hospital_name')
                    ->label('Preferred hospital'),
                TextColumn::make('preferred_date')
                    ->label('Preferred date')
                    ->date('F j, Y'),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all requests')
                    ->icon(Heroicon::OutlinedArrowRight)
                    ->url(fn () => VaccineRequestResource::getUrl('index')),
            ])
            ->emptyStateHeading('No pending requests')
            ->emptyStateIcon(Heroicon::OutlinedInbox);
    }
}
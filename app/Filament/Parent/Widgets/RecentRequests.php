<?php

namespace App\Filament\Parent\Widgets;

use App\Models\VaccineRequest;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class RecentRequests extends TableWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 3;
    protected ?string $maxHeight = '200px';

    protected static ?string $heading = 'Recent Requests';


    public static function canView(): bool
    {
        return Gate::allows('parent-view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                VaccineRequest::query()
                    ->whereHas('child', fn(Builder $q) => $q->where('user_id', auth()->id()))
                    ->with(['child', 'vaccine', 'hospital'])
            )
            ->defaultSort('created_at', 'desc')
            ->paginated([8])
            ->columns([
                TextColumn::make('child.name')->label('Child'),
                TextColumn::make('vaccine.name')->label('Vaccine'),
                TextColumn::make('hospital.hospital_name')->label('Hospital'),
                TextColumn::make('preferred_date')->label('Preferred date')->date('F j, Y'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),
            ]);
    }
}

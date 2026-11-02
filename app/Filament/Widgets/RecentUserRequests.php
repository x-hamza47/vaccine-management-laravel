<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Gate;

class RecentUserRequests extends TableWidget
{
    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return Gate::allows('admin-view');
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent User Requests')
            ->query(fn() => User::query()
                ->where('is_approved', false)
                ->latest()
                ->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->weight('bold'),
                TextColumn::make('email'),
                TextColumn::make('role')
                    ->label('Access level')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => ucfirst($state))
                    ->color(fn(string $state) => $state === 'hospital' ? 'info' : 'success'),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->since(),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->visible(fn() => Gate::allows('admin-view'))
                    ->authorize(fn() => Gate::allows('admin-view'))
                    ->action(function (User $record, Action $action) {
                        $record->update(['is_approved' => true]);
                        $action->success();
                    })
                    ->successNotificationTitle('User approved'),
                DeleteAction::make('reject')
                    ->label('Reject')
                    ->modalHeading('Reject this user?')
                    ->visible(fn() => Gate::allows('admin-view'))
                    ->authorize(fn() => Gate::allows('admin-view')),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all requests')
                    ->icon(Heroicon::OutlinedArrowRight)
                    ->url(fn() => UserResource::getUrl('index')),
            ])
            ->emptyStateHeading('No pending user requests')
            ->emptyStateIcon(Heroicon::OutlinedInbox);
    }
}

<?php

namespace App\Filament\Parent\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int|array
    {
        return 5;
    }
    public function mount(): void
    {
        if (auth()->user()?->role !== 'parent') {
            $this->redirect(url('/admin'));
        }
    }
}

<?php

namespace App\Filament\Resources\Childrens\Pages;

use App\Filament\Resources\Childrens\ChildrenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Gate;

class ManageChildrens extends ManageRecords
{
    protected static string $resource = ChildrenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateDataUsing(function (array $data): array {
                    if (Gate::allows('parent-view')) {
                        $data['user_id'] = auth()->id();
                    }

                    return $data;
                }),
        ];
    }
}

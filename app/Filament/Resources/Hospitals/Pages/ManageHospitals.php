<?php

namespace App\Filament\Resources\Hospitals\Pages;

use App\Filament\Resources\Hospitals\HospitalResource;
use App\Models\Hospital;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHospitals extends ManageRecords
{
    protected static string $resource = HospitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->using(function (array $data): Hospital {
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $data['password'],
                        'role' => 'hospital',
                        'is_approved' => true,
                    ]);

                    return $user->hospital()->create([
                        'hospital_name' => $data['hospital_name'],
                        'address' => $data['address'],
                        'location' => $data['location'],
                    ]);
                }),
        ];
    }
}

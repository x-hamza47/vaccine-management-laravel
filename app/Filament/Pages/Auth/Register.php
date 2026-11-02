<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('role')
                ->label('Register As')
                ->options([
                    'parent' => 'Parent',
                    'hospital' => 'Hospital',
                ])
                ->required()
                ->live(),

            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),


            Section::make('Hospital Information')
                ->visible(fn(Get $get) => $get('role') === 'hospital')
                ->schema([
                    TextInput::make('hospital_name')->required()->maxLength(100),
                    TextInput::make('address')->required()->maxLength(255),
                    TextInput::make('location')->label('Location (City/Area)')->required()->maxLength(100),
                ]),
        ]);
    }

    protected function handleRegistration(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role'],
                'is_approved' => false,
            ]);

            if ($data['role'] === 'hospital') {
                $user->hospital()->create([
                    'hospital_name' => $data['hospital_name'],
                    'address' => $data['address'],
                    'location' => $data['location'],
                ]);
            }

            return $user;
        });
    }


    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        $this->handleRegistration($data);

        Notification::make()
            ->title('Registration successful')
            ->body('Please wait for admin approval, then log in.')
            ->success()
            ->persistent()
            ->send();

        $this->redirect(Filament::getLoginUrl());

        return null;
    }
}

<?php

namespace App\Filament\Pages;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            TextInput::make('role')
                ->label('Access level')
                ->formatStateUsing(fn($state) => ucfirst($state))
                ->disabled()
                ->dehydrated(false),
            TextInput::make('hospital_name')
                ->required()
                ->maxLength(100)
                ->visible(fn() => Gate::allows('hospital-view')),
            TextInput::make('address')
                ->required()
                ->maxLength(255)
                ->visible(fn() => Gate::allows('hospital-view')),
            TextInput::make('location')
                ->required()
                ->maxLength(100)
                ->visible(fn() => Gate::allows('hospital-view')),
        ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $hospital = $this->getUser()->hospital;

        if ($hospital) {
            $data['hospital_name'] = $hospital->hospital_name;
            $data['address'] = $hospital->address;
            $data['location'] = $hospital->location;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $keys = ['hospital_name', 'address', 'location'];

        $record->update(Arr::except($data, $keys));

        if ($record->hospital) {
            $record->hospital->update(Arr::only($data, $keys));
        }

        return $record;
    }
}

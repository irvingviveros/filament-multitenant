<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Team;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Todo: This is where we need to add the team_id to the user. Add a selector to the form.
        $user = static::getModel()::create($data);
        $user->teams()->attach(auth()->user()->latest_team_id);

        return $user;
    }
}

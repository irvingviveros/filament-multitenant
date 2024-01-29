<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CreateUser
 *
 * This class represents the page for creating a new User in the Filament admin panel.
 * It extends the CreateRecord class provided by Filament.
 *
 * @package App\Filament\Resources\UserResource\Pages
 */
class CreateUser extends CreateRecord
{
    /**
     * The resource associated with the page.
     *
     * @var string
     */
    protected static string $resource = UserResource::class;

    /**
     * Handle the creation of a new User record.
     *
     * This method is called when a new User is created from the Filament admin panel.
     * It creates a new User record with the provided data, and associates the User with the current team.
     *
     * @param array $data The data for the new User.
     * @return Model The created User record.
     */
    protected function handleRecordCreation(array $data): Model
    {
        // create a new User record with the provided data
        $user = static::getModel()::create($data);

        // associate the User with the current team
        $user->teams()->attach(auth()->user()->latest_team_id);

        return $user;
    }
}

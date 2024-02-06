<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
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
}

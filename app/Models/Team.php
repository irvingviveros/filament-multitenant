<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * The "boot" method of the model.
     *
     * This method is a static function that is called when the model is booted.
     * It is used to define a callback to set up any model event hooks.
     *
     * When a new "Team" model is created, this function will:
     * - Store the latest team id of the authenticated user in the session.
     * - Log the session team id.
     * - Assign the newly created team to a global user with a global default role of 'Super Admin'.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        Session::put('team_id', auth()->user()->latest_team_id);
        error_log('Session team_id: ' . Session::get('team_id'));
        // here assign this team to a global user with global default role
        self::created(function ($teamModel) {
            // get session team_id to restore it later (maybe optional)
            $session_team_id = getPermissionsTeamId();
            setPermissionsTeamId($teamModel->id);
            User::find(1)->assignRole('Super Admin');
            setPermissionsTeamId($session_team_id);
        });
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function guardians(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }

    public function careers(): HasMany
    {
        return $this->hasMany(Career::class);
    }
}

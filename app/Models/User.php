<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * This class represents a User in the application. It extends the Authenticatable class provided by Laravel.
 * It implements the HasTenants interface, which means it has a relationship with the Tenant (Team) model.
 *
 * @package App\Models
 */
class User extends Authenticatable implements HasTenants
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasSuperAdmin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Get the tenants (teams) that the user belongs to.
     *
     * @param Panel $panel The Panel instance.
     * @return Collection The collection of teams that the user belongs to.
     */
    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    /**
     * Define the relationship between the User and Team models.
     *
     * @return BelongsToMany The relationship instance.
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Check if the user can access a specific tenant (team).
     *
     * @param Model $tenant The tenant (team) to check.
     * @return bool True if the user can access the tenant, false otherwise.
     */
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    /**
     * Retrieve all roles associated with the user.
     *
     * This method defines a many-to-many relationship between the User and Role models.
     * It uses the 'model_has_roles' pivot table to establish this relationship.
     * The 'model_id' and 'role_id' are used as the foreign keys in the pivot table.
     *
     * @return BelongsToMany The relationship instance.
     */
    public function getRoles(): BelongsToMany
    {
        // The 'model_id' and 'role_id' are used as the foreign keys in the pivot table. Concatenate the team id where the permission of the user belongs to.
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
            ->withPivot('team_id');
    }

    public function student(): HasOne
    {
        return $this->HasOne(Student::class);
    }

    public function guardian(): HasOne
    {
        return $this->HasOne(Guardian::class);
    }
}

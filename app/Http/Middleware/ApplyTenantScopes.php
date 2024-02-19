<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyTenantScopes
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     *
     * This method adds a global scope to the User model that only includes users who are part of the current tenant's team and do not have the 'Super Admin' role.
     * The global scope is applied using the `addGlobalScope` method of the User model.
     * The `whereHas` method is used to filter users who are part of the current tenant's team.
     * The `whereDoesntHave` method is used to exclude users who have the 'Super Admin' role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        User::addGlobalScope(function ($query) {
            $query->whereHas('teams', function ($query) {
                $query->where('team_id', Filament::getTenant()->id);
            })->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Super Admin');
            });
        });

        return $next($request);
    }
}

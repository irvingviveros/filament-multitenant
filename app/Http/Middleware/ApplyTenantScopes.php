<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyTenantScopes
{
    /**
     * This method applies a global scope to the User model.
     * A global scope is a constraint that is added to all queries on the model.
     * In this case, the constraint is that the query should only return users that are part of the current tenant's team.
     * The current tenant is retrieved using the Filament::getTenant() method.
     *
     * The addGlobalScope method takes a closure as an argument.
     * This closure receives a query builder instance and should return a modified query builder instance.
     * In this case, the closure adds a whereHas condition to the query.
     * The whereHas method adds a condition to the query that restricts the results to those that have a related record in another table.
     * In this case, the related table is the 'teams' table, and the condition is that the 'team_id' field in the 'teams' table should be equal to the id of the current tenant.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        User::addGlobalScope(
            fn (Builder $query) => $query->wherehas( 'teams', fn($query) => $query->where('team_id', Filament::getTenant()->id))
        );

        return $next($request);
    }
}

<?php
declare(strict_types=1);

namespace App\Http\Middleware;

class TeamPermission
{
    public function handle($request, \Closure $next){
        if(!empty(auth()->user())){
            $request->user()->unsetRelation('roles')->unsetRelation('permissions');
            // session value set on login
            setPermissionsTeamId(session('team_id'));
        }
        return $next($request);
    }
}

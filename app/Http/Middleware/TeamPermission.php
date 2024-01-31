<?php
declare(strict_types=1);

namespace App\Http\Middleware;

class TeamPermission
{
    public function handle($request, \Closure $next){
        if(!empty(auth()->user())){
            // session value set on login
            setPermissionsTeamId(session('team_id'));
            error_log('TeamPermission: ' . session('team_id'));
        }
        return $next($request);
    }
}

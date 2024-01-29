<?php

namespace App\Listeners;

use Filament\Events\TenantSet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLatestTeamId
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    /**
     * Handle the event.
     */
    public function handle(TenantSet $event): void
    {
        // get the user from the event
        $user = $event->getUser();

        // get the tenant (team) from the event
        $team = $event->getTenant();

        // update the user's latest_team_id
        $user->latest_team_id = $team->id;
        $user->save();
    }
}

<?php

namespace App\Listeners;

use Filament\Events\TenantSet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class UpdateLatestTeamId
 *
 * This class is an event listener that handles the TenantSet event.
 * It updates the latest_team_id attribute of the user associated with the event.
 *
 * @package App\Listeners
 */
class UpdateLatestTeamId
{
    /**
     * Create the event listener.
     *
     * This is the constructor of the class. It currently does not perform any operations.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * This method is triggered when a TenantSet event is dispatched.
     * It retrieves the user and the tenant (team) from the event,
     * and updates the user's latest_team_id with the id of the team.
     *
     * @param TenantSet $event The TenantSet event instance.
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

<?php
declare(strict_types=1);

namespace App\Http\Responses;

use App\Models\Team;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * Class LoginResponse
 *
 * This class extends the Filament's LoginResponse class and overrides the toResponse method.
 * The toResponse method is responsible for handling the response after a successful login.
 *
 * @package App\Http\Responses
 */
class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    /**
     * Handle the response after a successful login.
     *
     * This method checks if the logged-in user is an admin.
     * If the user is an admin and there is no current tenant, it redirects the user to the tenant registration page.
     * If the user is an admin and there is a current tenant, it sets the current panel to 'admin' and redirects the user to the admin page.
     * If the user is not an admin, it calls the parent class's toResponse method.
     *
     * @param Request $request incoming HTTP request.
     * @return RedirectResponse|Redirector The response after a successful login.
     */
    public function toResponse($request): RedirectResponse|Redirector
    {
        if ($request->user()->is_admin && Team::all()->isEmpty()) {
            return redirect()->route('filament.app.tenant.registration');
        } elseif ($request->user()->is_admin) {
            Filament::setCurrentPanel(Filament::getPanel('admin'));
            return redirect()->to('/admin');
        }
        return parent::toResponse($request);
    }
}

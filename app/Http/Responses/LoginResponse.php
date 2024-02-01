<?php
declare(strict_types=1);

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // if the user is an admin, redirect them to the admin panel
        if ($request->user()->is_admin) {
            // Set the current panel to 'admin'
            Filament::setCurrentPanel(Filament::getPanel('admin'));
            return redirect()->to('/admin');
        }

        return parent::toResponse($request);
    }
}

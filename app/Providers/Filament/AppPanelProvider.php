<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Althinect\FilamentSpatieRolesPermissions\Middleware\SyncSpatiePermissionsWithFilamentTenants;
use App\Filament\App\Pages\Tenancy\EditTeamProfile;
use App\Filament\App\Pages\Tenancy\RegisterTeam;
use App\Http\Middleware\ApplyTenantScopes;
use App\Http\Middleware\TeamPermission;
use App\Models\Team;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->profile()
            ->userMenuItems([
                MenuItem::make()
                    ->label('Admin')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/admin')
                    ->visible(fn (): bool => auth()->user()->is_admin),
            ])
            ->tenantMenu(fn (): bool => (auth()->user()->is_admin || auth()->user()->teams->count() > 1))
            ->tenantMenuItems([
                'register' => MenuItem::make()->label('Registrar plantel')->visible(fn (): bool => auth()->user()->is_admin),
                'profile' => MenuItem::make()->label('Información de plantel')->visible(fn (): bool => auth()->user()->is_admin),
                // ...
            ])
            ->colors([
                'primary' => Color::Blue,
                'gray' => Color::Slate,
            ])
            ->maxContentWidth(MaxWidth::Full)
            ->font('Inter')
            ->navigationGroups([
                'User Management'
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->spa()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                TeamPermission::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenant(Team::class, slugAttribute: 'slug', ownershipRelationship: 'team')
            ->tenantMiddleware([
                SyncSpatiePermissionsWithFilamentTenants::class,
                ApplyTenantScopes::class,
            ], isPersistent: true)
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->tenantRegistration(RegisterTeam::class)
            ->tenantProfile(EditTeamProfile::class);
    }
}

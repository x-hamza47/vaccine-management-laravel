<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Register;
use App\Filament\Pages\EditProfile;
use App\Filament\Parent\Pages\Dashboard;
use App\Filament\Resources\VaccinationSchedules\VaccinationScheduleResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ParentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('parent')
            ->path('dashboard')
            ->brandName('MediLab')
            ->font('Poppins')
            ->login()
            ->registration(Register::class)
            ->colors([
                'primary' => Color::hex('#2563EB'),
            ])
            ->discoverResources(in: app_path('Filament/Parent/Resources'), for: 'App\Filament\Parent\Resources')
            ->resources([
                \App\Filament\Resources\Childrens\ChildrenResource::class,
                \App\Filament\Resources\VaccineRequests\VaccineRequestResource::class,
                VaccinationScheduleResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Parent/Pages'), for: 'App\Filament\Parent\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn() => new HtmlString('<style>.fi-badge { border-radius: 9999px !important; padding-inline: 0.65rem; }</style>')
            )
            ->discoverWidgets(in: app_path('Filament/Parent/Widgets'), for: 'App\Filament\Parent\Widgets')
            ->widgets([
                //
            ])
            ->profile(EditProfile::class)
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}

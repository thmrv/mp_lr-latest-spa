<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Js;
use Filament\Navigation\NavigationGroup;
use Afsakar\FilamentOtpLogin\FilamentOtpLoginPlugin;
use SolutionForest\FilamentTranslateField\FilamentTranslateFieldPlugin;

class AdminPanelProvider extends PanelProvider
{

    public function boot(): void {

    }

    public function panel(Panel $panel): Panel
    {
        FilamentAsset::register([
            Css::make('laraberg_styles', './public/css/admin/editor.css'),
        ]);

        FilamentAsset::register([
            Js::make('laraberg_scripts', './public/js/admin/editor.js'),
        ]);

        return $panel
            ->default()
            ->id('admin')
            ->path(env('ADM_PANEL_PATH'))
            ->brandName(env('ADM_PANEL_NAME'))
            ->login()
            ->breadcrumbs()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
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
            ])
            ->spa()
            ->navigationGroups([
                NavigationGroup::make()
                     ->label(ucfirst((string)__('filament/navigation/sidebar.all'))),
                NavigationGroup::make()
                     ->label(ucfirst((string)__('filament/navigation/sidebar.other')))
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                FilamentOtpLoginPlugin::make(),
                FilamentTranslateFieldPlugin::make()->defaultLocales(['en', 'ru', 'cn', 'kr'])
            ]);
    }
}

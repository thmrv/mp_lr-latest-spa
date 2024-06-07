<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Robots extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 98;

    protected static ?string $modelLabel = 'ASS';

    public static function getNavigationGroup(): ?string {
        return ucfirst((string)__('filament/navigation/sidebar.other'));
     }

    protected static string $view = 'filament.pages.robots';
}

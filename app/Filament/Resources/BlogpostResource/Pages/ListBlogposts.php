<?php

namespace App\Filament\Resources\BlogpostResource\Pages;

use App\Filament\Resources\BlogpostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogposts extends ListRecords
{
    protected static string $resource = BlogpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

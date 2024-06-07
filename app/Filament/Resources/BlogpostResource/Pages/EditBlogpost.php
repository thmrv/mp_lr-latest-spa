<?php

namespace App\Filament\Resources\BlogpostResource\Pages;

use App\Filament\Resources\BlogpostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogpost extends EditRecord
{
    protected static string $resource = BlogpostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

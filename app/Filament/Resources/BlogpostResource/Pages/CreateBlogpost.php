<?php

namespace App\Filament\Resources\BlogpostResource\Pages;

use App\Filament\Resources\BlogpostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogpost extends CreateRecord
{
    protected static string $resource = BlogpostResource::class;
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogpostResource\Pages;
use App\Filament\Resources\BlogpostResource\RelationManagers;
use App\Models\Blogpost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class BlogpostResource extends Resource
{
    protected static ?string $model = Blogpost::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst((string)__('filament/navigation/sidebar.all'));
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return (string)__('filament/resources/blogposts.label');
    }

    public static function getPluralModelLabel(): string
    {
        return (string)__('filament/resources/blogposts.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogposts::route('/'),
            'create' => Pages\CreateBlogpost::route('/create'),
            'edit' => Pages\EditBlogpost::route('/{record}/edit'),
        ];
    }
}

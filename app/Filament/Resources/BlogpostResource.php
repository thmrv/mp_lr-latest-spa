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
use App\Traits\Meta\Metable;

class BlogpostResource extends Resource
{
    use Metable;
 
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

    /*
    @var string $randomSalad
    */
    public static function form(Form $form): Form
    {
        $randomSalad = randomSalad();

        $schema = [
            Forms\Components\TextInput::make('slug')
                ->maxLength(255)
                ->default(null)
                ->translateLabel(),
            Forms\Components\TextInput::make('pathname')
                ->maxLength(255)
                ->default(null)
                ->required()
                ->default($randomSalad)
                ->translateLabel(),
            Forms\Components\TextInput::make('page_name')
                ->prefix('resources/views/templates/')
                ->suffix('.blade.php')
                ->columnSpan(1),
            Translate::make()
                ->columnSpanFull()
                ->columns(2)
                ->schema(
                    array_merge(Metable::attachToPanel(), [
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Hidden::make('description'),
                        Forms\Components\RichEditor::make('name')->columnSpanFull(),
                    ])
                )->prefixLocaleLabel()
                ->fieldTranslatableLabel(fn ($field, $locale) => __($field->getName(), locale: $locale))
                ->statePath('data')
                ->locales(['en', 'ru', 'zh', 'ko']),
        ];

        return $form->schema($schema);
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

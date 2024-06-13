<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletes;
use PageEditor;
use App\Traits\Meta\Metable;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;

class PageResource extends Resource
{
    use SoftDeletes;
    use Metable;

    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
        return (string)__('filament/resources/pages.label');
    }

    public static function getPluralModelLabel(): string
    {
        return (string)__('filament/resources/pages.plural');
    }

    public static function form(Form $form): Form
    {

        $randomSalad = randomSalad();

        $schema = [
            Forms\Components\Toggle::make('enabled')
                ->required()
                ->default(true)
                ->columnSpan('full'),
            Forms\Components\TextInput::make('name')
                ->maxLength(255)
                ->default('')
                ->columnSpan('1')
                ->required()
                ->default($randomSalad),
            Forms\Components\TextInput::make('slug')
                ->maxLength(255)
                ->default($randomSalad)
                ->columnSpan(1)
                ->translateLabel(),
            Forms\Components\TextInput::make('pathname')
                ->maxLength(255)
                ->default(null)
                ->columnSpan(1)
                ->required()
                ->default($randomSalad),
            Forms\Components\TextInput::make('template_name')
                ->prefix('resources/views/templates/')
                ->suffix('.blade.php')
                ->columnSpan(1)
                ->default('single'),
            Translate::make()
                ->columnSpanFull()
                ->columns(2)
                ->schema(
                    array_merge(Metable::attachToPanel(), [
                        Forms\Components\TextInput::make('title'),
                        Forms\Components\Hidden::make('description'),
                        Forms\Components\TextInput::make('name')->columnSpanFull(),
                    ])
                )
                ->fieldTranslatableLabel(fn ($field, $locale) => __($field->getName(), locale: $locale)),
        ];

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\IconColumn::make('enabled')
                    ->boolean()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('pathname')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('template_name')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
            ]);
        /*->filters([
                Tables\Filters\TrashedFilter::make(),
                // ...
            ])*/
        /*->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                // ...
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    // ...
                ]),
            ])*/
    }

    /*protected function getHeaderActions(): array
    {
        return [
            CommentsAction::make(),
        ];
    }*/

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => PageEditor::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}

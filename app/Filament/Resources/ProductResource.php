<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;
use App\Traits\Meta\Metable;

class ProductResource extends Resource
{
    use SoftDeletes;
    use Metable;

    protected static ?string $model = Product::class;

    public static function getNavigationGroup(): ?string
    {
        return ucfirst((string)__('filament/navigation/sidebar.all'));
    }

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return (string)__('filament/resources/products.label');
    }

    public static function getPluralModelLabel(): string
    {
        return (string)__('filament/resources/products.plural');
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
            Forms\Components\TextInput::make('charge_annual')
                ->numeric()
                ->default(null)
                ->translateLabel(),
            Forms\Components\TextInput::make('price_static')
                ->required()
                ->numeric()
                ->default(0)
                ->translateLabel(),
            Forms\Components\TextInput::make('discount')
                ->required()
                ->numeric()
                ->default(0)
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
                        Forms\Components\TextInput::make('name')->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pathname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('charge_annual')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_static')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                // ...
            ])
            ->actions([
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

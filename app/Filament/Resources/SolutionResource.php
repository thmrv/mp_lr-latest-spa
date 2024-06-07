<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolutionResource\Pages;
use App\Filament\Resources\SolutionResource\RelationManagers;
use App\Models\Solution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolutionResource extends Resource
{
    use SoftDeletes;

    protected static ?string $model = Solution::class;

    public static function getNavigationGroup(): ?string
    {
        return ucfirst((string)__('filament/navigation/sidebar.all'));
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    public static function getModelLabel(): string
    {
        return (string)__('filament/resources/solutions.label');
    }

    public static function getPluralModelLabel(): string
    {
        return (string)__('filament/resources/solutions.plural');
    }

    /*
    @var string $randomSalad
    */
    public static function form(Form $form): Form
    {
        $randomSalad = randomSalad();

        $schema = [
            Forms\Components\TextInput::make('name')
                ->maxLength(255)
                ->default(null)
                ->required()
                ->default($randomSalad),
            Forms\Components\TextInput::make('description')
                ->maxLength(255)
                ->default(null),
            Forms\Components\TextInput::make('slug')
                ->maxLength(255)
                ->default(null),
            Forms\Components\TextInput::make('pathname')
                ->maxLength(255)
                ->default(null)
                ->required()
                ->default($randomSalad),
            Forms\Components\TextInput::make('charge_annual')
                ->numeric()
                ->default(null),
            Forms\Components\TextInput::make('price_static')
                ->required()
                ->numeric()
                ->default(0),
            Forms\Components\TextInput::make('discount')
                ->required()
                ->numeric()
                ->default(0),
            Forms\Components\TextInput::make('title')
                ->maxLength(255)
                ->default(null)
                ->columnSpan(1),
            Forms\Components\TextInput::make('template_name')
                ->prefix('resources/views/templates/')
                ->suffix('.blade.php')
                ->columnSpan(1)
                ->required()
                ->default('service'),
        ];

        if (getLocales() ?? ['en'])
            foreach (getLocales() as $locale) {
                if ($locale !== env('APP_LOCALE')) {
                    array_push(
                        $schema,
                        Forms\Components\RichEditor::make('title_' . $locale)
                            ->default(null)
                            ->columnSpan('full'),
                    );
                    array_push(
                        $schema,
                        Forms\Components\RichEditor::make('description_' . $locale)
                            ->default(null)
                            ->columnSpan('full'),
                    );
                }
            }

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
            'index' => Pages\ListSolutions::route('/'),
            'create' => Pages\CreateSolution::route('/create'),
            'edit' => Pages\EditSolution::route('/{record}/edit'),
        ];
    }
}

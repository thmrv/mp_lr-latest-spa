<?php

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\Page;
use Filament\Actions;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Log;
use SolutionForest\FilamentTranslateField\Forms\Component\Translate;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class PageEditor extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = PageResource::class;

    protected static ?string $title = '';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getResource(): string
    {
        return PageResource::class;
    }

    public function form(Form $form): Form
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
                ->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\TextInput::make('content'),
                    Forms\Components\RichEditor::make('description')->columnSpanFull(),
                ])
                ->fieldTranslatableLabel(fn ($field, $locale) => __($field->getName(), locale: $locale))
                ->statePath('data'),
        ];

        return $form->schema($schema);
    }

    public function getFormStatePath(): ?string
    {
        return null;
    }

    protected static string $view = 'filament.resources.page-resource.pages.page-editor';
}

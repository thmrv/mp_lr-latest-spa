<?php

namespace App\Filament\Pages;

use Exception;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Wiebenieuwenhuis\FilamentCodeEditor\Components\CodeEditor;
use Illuminate\Support\Facades\Log;

class Terminal extends Page implements HasForms
{
    use InteractsWithForms;

    public function getFormStatePath(): ?string
    {
        return null;
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 100;

    protected static ?string $modelLabel = 'robots.txt';

    protected static ?string $filename = 'robots.txt';

    protected static ?string $title = 'robots.txt';

    protected static ?string $pathname = './';

    protected static ?string $navigationLabel = 'robots.txt';

    public static function getNavigationGroup(): ?string
    {
        return ucfirst((string)__('filament/navigation/sidebar.other'));
    }


    /**
     */
    public function form(Form $form): Form
    {

        $schema = [
            
            /*RichEditor::make('robots')
                ->columnSpan('full')
                ->label('')
                ->default(self::getRobotsContents())
                ->toolbarButtons([
                    'redo',
                    'undo',
                ]),*/

            CodeEditor::make('contents')
                ->default(self::getRobotsContents())
                ->label('')
        ];

        Log::warning(self::getRobotsContents());

        return $form->schema($schema);
    }

    /**
     * Outputs the updated contents from root/robots.txt
     * Laravel storage not fully applicable here, stock callback used.
     * @var mixed $contents
     * @return string|false|\Exception
     */
    protected static function getRobotsContents()
    {
        $contents = '';
        try {
            $contents = file_get_contents(self::$pathname . self::$filename, 1);
        } catch (Exception $exception) {
            return $exception;
        } finally {
            return $contents;
        }
    }

    /**
     * Saves the updated contents into root/robots.txt
     * Laravel storage not fully applicable here, stock callback used.
     * @var mixed $contents
     * @return string|false|\Exception
     */
    protected static function saveRobotsContents($contents)
    {
        try {
            file_put_contents(self::$pathname . self::$filename, $contents);
        } catch (Exception $exception) {
            return $exception;
        } finally {
            return true;
        }
    }



    protected static string $view = 'filament.pages.robots';
}

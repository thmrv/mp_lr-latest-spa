<?php

namespace App\Traits\Meta;

use Illuminate\Support\Facades\Schema;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Log;
use Spatie\Translatable\HasTranslations;

trait Metable
{

    private $metaFillables = ['meta_title', 'meta_description', 'meta_keywords', 'meta_googleBot', 'meta_google_verification', 'meta_googlebot', 'meta_robots'];

    public function getMetaTitle()
    {
        return $this->fillable['meta_title'];
    }

    public function getMetaDesciption()
    {
        return $this->fillable['meta_description'];
    }

    public function getMetaKeywords()
    {
        return $this->fillable['meta_keywords'];
    }

    public function getMetaRobots()
    {
        return $this->fillable['meta_robots'];
    }

    /**
     * Updates model class to include meta fillables,
     * // Should rewrite as its own cast property group as in $translatable
     * @return Schema | array
     */
    public function attachToFillable()
    {
        foreach ($this->metaFillables as $fillable) {
            $this->fillable[] = $fillable;
        }
        return true;
    }

    public function attachToTranslatable()
    {
        foreach ($this->metaFillables as $fillable) {
            $this->translatable[] = $fillable;
        }
        return true;
    }

    public function initializeMetable()
    {
        return !$this->isTranslatable() ? $this->attachToFillable() : $this->attachToTranslatable();
    }

    public function isTranslatable()
    {
        return in_array(HasTranslations::class, class_uses_recursive(get_class($this)));
    }

    /**
     * Updates migration file to include meta fields
     * @return Schema | array
     */
    public static function attachToMigration($tableName)
    {
        return Schema::table($tableName, function ($table) {
            foreach (getLocales() as $locale) {
                $table->string('meta_title_' . $locale)->nullable();
                $table->string('meta_description_' . $locale)->nullable();
                $table->string('meta_keywords_' . $locale)->nullable();
            }
            $table->string('meta_googlebot')->nullable();
            $table->string('meta_google_verification')->nullable();
            $table->string('meta_robots')->nullable();
        });
    }

    /**
     * Updates resource panel class to include meta fields, 
     * should be used in the form
     * Won't include robot metas for now
     * @return Schema | array
     */
    public static function attachToPanel()
    {
        return [
            TextInput::make('meta_title'),
            TextInput::make('meta_description'),
            TextInput::make('meta_keywords'),
            //TextInput::make('meta_robots')->required(),
            //TextInput::make('meta_googlebot')->required(),
            //TextInput::make('meta_google_verification')->required(),
        ];
    }
}

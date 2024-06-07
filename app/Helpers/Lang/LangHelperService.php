<?php 

namespace App\Helpers\Lang;

use Error;
use Illuminate\Support\Facades\Config;

class LangHelperService {

    private static function FetchDir(): string {
        return Config::get('app.langdirectory') ?? './lang/';
    }

    private static function scanLocales() {
        return scandir(self::FetchDir());
    }

    function sort($locale) {
        $restrictedValues = ['vendor', '.', '..', '...', ';', '.old'];
        foreach ($restrictedValues as $index => $value) {
            if (str_contains($locale, $value)){
                return;
            }
            return $locale;
        }
    }

    private static function filterLocales() {
        $rawLocales = self::scanLocales();
        if ($rawLocales) {
            return array_filter($rawLocales, "sort");
        }
        throw new \Exception('Lang directory either empty or absent altogether.');
    }

    public static function getCompletedLocales() {
        return self::filterLocales();
    }

    public static function insertMissingModelAttributes(string $modelClass, ?string $prefix = 'content') {

    }

    public static function insertMissingMigrationFields(string $typecast = 'string', ?string $prefix = 'content') {

    }
}
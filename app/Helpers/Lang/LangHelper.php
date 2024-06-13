<?php

/**
 * 
 *
 * @var hiddenLocale<string>
 */

function getLocales()
{
    $hiddenLocale = 'ru';
    $rawLocales = scandir(base_path() . '/' . env('APP_LOCALE_DIRECTORY'));
    if ($rawLocales) {
        return array_filter($rawLocales, function ($locale) {
            return strpos($locale, '.') === false && strpos($locale, 'vendor') && strpos($locale, $hiddenLocale ?? 'ru') === false;
        });
    } else {
        throw new \Exception('Lang directory either empty or absent altogether.');
    }
}

function getLocalesStatic() {
    return ['ru', 'en', 'ko', 'zh'];
}

function randomSalad()
{
    return substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm"), 0, 6);
}

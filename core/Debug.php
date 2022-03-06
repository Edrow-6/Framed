<?php

namespace Core;

class Debug
{
    public static function load(bool $state): void
    {
        if ($state) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);

            \Spatie\Ignition\Ignition::make()->applicationPath(__DIR__.'/../')->useDarkMode()->register();
            //\Symfony\Component\ErrorHandler\Debug::enable();
        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(E_ALL);
        }
    }
}
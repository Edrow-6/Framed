<?php

namespace Core;

use JetBrains\PhpStorm\ArrayShape;

class Settings
{
    public static function load(): array
    {
        $defaultSettings = self::getDefault();
        $appSettings = self::getApp();
        $settings = $defaultSettings;

        if ($appSettings) {
            $settings = array_merge($defaultSettings, $appSettings);
        }

        return $settings;
    }

    #[ArrayShape(['name' => "mixed", 'debug' => "bool", 'url' => "mixed", 'database' => "array", 'logger' => "array", 'root_path' => "string"])]
    private static function getDefault(): array
    {
        $rootPath = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR;

        return [
            'name' => env('APP_NAME', 'Framed'),
            'debug' => (bool) env('APP_DEBUG', false),
            'url' => env('APP_URL', 'http://localhost'),

            'database' => [
                'driver' => env('DB_DRIVER', 'mysql'),
                'host' => env('DB_HOST', 'localhost'),
                'name' => env('DB_NAME', 'frawks'),
                'user' => env('DB_USER', 'root'),
                'password' => env('DB_PASS'),
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => env('DB_PREFIX', '')
            ],

            'logger' => [
                'error' => [
                    'enabled' => true,
                    'details' => true
                ],
                'name' => 'framed',
                'path' => env('LOG_PATH') !== null ? 'php://stdout' : __DIR__ . '/../tmp/logs/app.log',
                'level' => \Monolog\Logger::DEBUG,
            ],

            'root_path' => $rootPath
        ];
    }

    private static function getApp(): \Laminas\Config\Config|array
    {
        if (!file_exists(__DIR__.'/../config/application.php')) {
            self::create();
        }
        return \Laminas\Config\Factory::fromFile(__DIR__.'/../config/application.php');
    }

    public static function create(): bool
    {
        if (\Laminas\Config\Factory::toFile(__DIR__.'/../config/application.php', ['setup' => false])) {
            return true;
        }

        return false;
    }

    public static function update($settings): bool
    {
        $appSettings = self::getApp();

        if ($appSettings) {
            $settingsWhitelist = [
                'name' => true,
                'debug' => true,
                'url' => true,
                'database' => [
                    'driver' => true,
                    'host' => true,
                    'name' => true,
                    'user' => true,
                    'password' => true,
                    'prefix' => true
                ],
                'logger' => [
                    'error' => [
                        'enabled' => true,
                        'details' => true
                    ]
                ],
                'setup' => true,
                'plugins' => true
            ];

            $appSettings = array_intersect_key($appSettings, $settingsWhitelist);
            $settings = array_intersect_key($settings, $settingsWhitelist);
            $settings = array_merge($appSettings, $settings);

            if (\Laminas\Config\Factory::toFile(__DIR__.'/../config/application.php', $settings)) {
                return true;
            }
        }
        return false;
    }
}
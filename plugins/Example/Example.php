<?php

namespace Plugins\Example;

use Core\Plugin;
use JetBrains\PhpStorm\ArrayShape;

class Example extends Plugin
{
    #[ArrayShape(['BaseEvent' => "string"])]
    public static function getSubscribedEvents(): array
    {
        return ['BaseEvent' => 'main'];
    }

    public static function main(): void
    {
        echo 'Example Plugin';
    }

    public static function routes(): array
    {
        return require __DIR__.'/routes.php';
    }
}
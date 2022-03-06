<?php

return [
    'settings' => static function () {
        return \Core\Settings::load();
    },

    Slim\App::class => static function (\Psr\Container\ContainerInterface $container) {
        return \DI\Bridge\Slim\Bridge::create($container);
    }
];
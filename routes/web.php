<?php

$path = 'App\Http\Controllers\\';

/**
 * @var mixed|Slim\App $app
 */
$app->get('/', $path.'HomeController:show')->setName('home.show');

/**
 * @var array $routes
 */
foreach ($routes as $route) {
    $method = $route['method'];
    $pattern = $route['pattern'];
    $callback = $route['callback'];
    $name = $route['name'] ?? str_replace('/', '', $pattern);

    $app->{$method}($pattern, $callback)->setName($name);
}
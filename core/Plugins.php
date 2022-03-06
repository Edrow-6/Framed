<?php

namespace Core;

class Plugins
{
    public function autoload(): array
    {
        $pluginFolder = $this->scanPluginFolder();
        $pluginNames = [];

        foreach ($pluginFolder as $plugin) {
            $folderName = $loaderName = ucwords($plugin);
            if (ctype_lower($plugin)) {
                $folderName = strtolower($plugin);
            }
            $pluginClass = '\\Plugins\\'.$folderName.'\\'.$loaderName;

            if (class_exists($pluginClass)) {
                $pluginNames[] = ['class' => $pluginClass, 'name' => $folderName];
            }
        }
        return $pluginNames;
    }

    public function loadRoutes($pluginName, $routes)
    {
        if (method_exists($pluginName, 'routes')) {
            $moduleRoutes = $pluginName::routes();

            if (isset($moduleRoutes[0])) {
                foreach ($moduleRoutes as $moduleRoute) {
                    if ($this->checkRouteArray($moduleRoute)) {
                        $moduleRoute['pattern'] = strtolower($moduleRoute['pattern']);
                        $routes[] = $moduleRoute;
                    }
                }
            } elseif (is_array($routes)) {
                if ($this->checkRouteArray($moduleRoutes)) {
                    $moduleRoutes['pattern'] = strtolower($moduleRoutes['pattern']);
                    $routes[] = $moduleRoutes;
                }
            }
        }
        return $routes;
    }

    private function checkRouteArray($route): bool
    {
        return isset($route['method'], $route['pattern'], $route['callback']) && in_array($route['method'], array('get', 'post', 'put', 'delete', 'options', 'patch', 'any')) && is_string($route['pattern']) && is_string($route['callback']);
    }

    private function scanPluginFolder(): array
    {
        $path = __DIR__.'/../plugins/';

        if (!is_dir($path)) {return [];}
        return array_diff(scandir($path), ['..', '.']);
    }
}
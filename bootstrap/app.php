<?php

require_once __DIR__.'/../libs/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$settings = \Core\Settings::load();

\Core\Debug::load($settings['debug']);

$builder = new \DI\ContainerBuilder();

if ($settings['debug']) {
    $builder->enableCompilation(__DIR__.'/../tmp/cache/container');
    $builder->writeProxiesToFile(true, __DIR__.'/../tmp/cache/proxies');
}

$builder->addDefinitions(__DIR__.'/../config/container.php');

$container = $builder->build();
$app = $container->get(\Slim\App::class);

$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

$plugins = (new \Core\Plugins())->autoload();
$pluginSettings = $routes = [];

foreach ($plugins as $plugin) {
    $pluginClass = $plugin['class'];
    $pluginName = $plugin['name'];

    if (isset($settings['plugins'][$pluginName])) {
        $pluginSettings[$pluginName] = $settings['plugins'][$pluginName];
        unset($settings['plugins'][$pluginName]);
    } else {
        $pluginSettings = [$pluginName => false];
        $reloadSettings = true;
    }

    if ($pluginSettings[$pluginName]) {
        $routes = (new \Core\Plugins())->loadRoutes($pluginClass, $routes);
        $dispatcher->addSubscriber(new $pluginClass($container));
    }
}

if (!empty($settings['plugins'])) { $reloadSettings = true; }
$settings['plugins'] = $pluginSettings;

if (isset($reloadSettings)) {
    $container->set('settings', $settings);
    $reloadSettings = \Core\Settings::update($settings);
}

function getViewPaths(array $settings): array
{
    $results[] = __DIR__.'/../app/resources/views';
    foreach ($settings['plugins'] as $plugin => $value) {
        $results[] = __DIR__.'/../plugins/'.$plugin.'/resources/views';
    }
    return $results;
}

$container->set('dispatcher', $dispatcher);
$container->set('view', new \eftec\bladeone\BladeOne(getViewPaths($settings), __DIR__.'/../tmp/cache/blade'));

require __DIR__ . '/../routes/web.php';

$app->run();
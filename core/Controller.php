<?php

namespace Core;

use DI\Container;
use Slim\Psr7\Response;

class Controller
{
    protected Container $container;
    private array $settings;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->settings = $this->container->get('settings');
    }

    public function view(Response $response, string $template, $params = []): Response
    {
        $blade = $this->container->get('view');
        //$blade->addAssetDict([]);

        $defaultParams = ['app' => $this->settings['name']];
        $mergedParams = array_merge($params, $defaultParams);

        $response->getBody()->write($blade->run($template, $mergedParams));
        return $response;
    }
}
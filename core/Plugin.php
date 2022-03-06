<?php

namespace Core;

use DI\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class Plugin implements EventSubscriberInterface
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
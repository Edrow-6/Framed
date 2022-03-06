<?php

namespace Core\Events;

use Symfony\Contracts\EventDispatcher\Event;

class BaseEvent extends Event
{
    protected mixed $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
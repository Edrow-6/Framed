<?php

$path = 'Plugins\\'.basename(__DIR__).'\Http\Controllers\\';

return [
    ['method' => 'get', 'pattern' => '/first', 'callback' => $path.'ExampleController:first', 'name' => 'example.first'],
    ['method' => 'get', 'pattern' => '/second', 'callback' => $path.'ExampleController:second'],
];
<?php

namespace Plugins\Example\Http\Controllers;

use Core\Controller;
use Slim\Psr7\Response;

class ExampleController extends Controller
{
    public function first(Response $response): Response
    {
        return $this->view($response, 'pages.first');
    }

    public function second(Response $response): Response
    {
        return $this->view($response, 'pages.second');
    }
}
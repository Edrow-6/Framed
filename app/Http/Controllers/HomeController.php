<?php

namespace App\Http\Controllers;

use Core\Controller;
use Slim\Psr7\Response;

class HomeController extends Controller
{
    public function show(Response $response): Response
    {
        return $this->view($response, 'pages.home');
    }
}
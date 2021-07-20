<?php

namespace App\Controllers;

use App\Routes\Router;

class HomeController
{
    public static function index(Router $router)
    {
        $router->renderView('index');
    }
}
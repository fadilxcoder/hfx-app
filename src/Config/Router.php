<?php

namespace App\Config;

use FastRoute\RouteCollector;
use App\Controller\{AuthController, AppController};

class Router
{
    public static function config()
    {
        return \FastRoute\simpleDispatcher(function (RouteCollector $routes) {
            $routes->addRoute(['GET', 'POST'], '/', [AuthController::class, 'login']);
            $routes->addRoute(['GET', 'POST'], '/login', [AuthController::class, 'login']);
            $routes->addRoute('GET', '/logout', [AuthController::class, 'logout']);
            $routes->addRoute('GET', '/dashboard', [AppController::class, 'dashboard']);
            $routes->addRoute(['GET', 'POST'], '/algolia', [AppController::class, 'algolia']);
            $routes->addRoute(['GET', 'POST'], '/elasticsearch', [AppController::class, 'elasticsearch']);
            $routes->addRoute('GET', '/users', [AppController::class, 'users']);
        });
    }
}
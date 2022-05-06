<?php

namespace Beejee\App\Core;

use Beejee\App\Controllers;
use Beejee\App\Models;

class Route
{
    public static function start()
    {
        $routes = explode("?", $_SERVER['REQUEST_URI'])[0];
        $routes = explode('/', $routes);

        $controllerName = 'Main';
        if (!empty($routes[1])) $controllerName = $routes[1];
        $actionName = $routes[2] ?? 'Index';

        try {
            $controllerName = "\\Beejee\\App\\Controllers\\" . ucfirst($controllerName) . 'Controller';
            $actionName = 'action' . ucfirst($actionName);

            $controller = new $controllerName();
            $controller->$actionName();

        } catch (\Throwable $error) {
            Route::ErrorPage404();
        }

    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'nf404');
    }
}
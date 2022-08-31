<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Controllers\Welcome;

class Router
{
    private $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function runRoute() :void
    {
        if ($this->uri == '/') {
            $controller = new Welcome();
        } else {

            $path = explode('/', $this->uri);
            $method = ucfirst(end($path));
            $method = ucfirst($method);
            $className = 'App\\Controllers\\' . $method;

            if (class_exists($className)) {
                $controller = new $className;
            } else {
                $controller = new PageNotFound();
            }
        }

        $controller->greetUser();
    }
}
<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Controllers\Mainpage;

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
            $controller = new Mainpage();
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
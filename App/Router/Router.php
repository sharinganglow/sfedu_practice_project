<?php

namespace App\Router;

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
            echo 'Hello there, welcome to homepage';
        }

        $path = explode('/', $this->uri);
        $method = ucfirst(end($path));
        $method = ucfirst($method);
        $className = 'App\\Controllers\\' . $method;

        if (class_exists($className)) {
            $controller = new $className;
            $controller->greetUser();
        } else {
            echo '404 incorrect url';
        }
    }
}
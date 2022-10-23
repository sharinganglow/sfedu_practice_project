<?php

namespace App\Router;

class Router
{
    protected $uri;

    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    public function selectController(): void
    {
        $router = $this->selectRouter();
        $router->runRoute();
    }

    public function selectRouter(): Router
    {
        if ($this->isApi()) {
            return new ApiRouter($this->uri);
        }
        return new WebRouter($this->uri);
    }

    public function isApi(): bool
    {
        return (bool)stripos($this->uri, 'api/');
    }
}
<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Controllers\Mainpage;
use App\Models\SessionModel;

class WebRouter extends Router
{
    protected $uri;

    public function runRoute(): void
    {
        SessionModel::getInstance()->start();
        $route  = strpos($this->uri, '/');
        $queryParamsIndex = strpos($this->uri, '?');

        if ($queryParamsIndex === false) {
            $this->uri = substr($this->uri, $route);
        } else {
            $this->uri = substr($this->uri, $route, $queryParamsIndex);
        }

        if ($this->uri == '/') {
            $controller = new Mainpage();
        } else {

            $path = explode('/', $this->uri);
            $method = ucfirst(end($path));
            $className = 'App\\Controllers\\' . $method;

            $controller = class_exists($className) ? new $className : new PageNotFound();
        }

        $controller->execute();
    }
}
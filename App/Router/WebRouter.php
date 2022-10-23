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
        $branch  = strpos($this->uri, '/');
        $queryParamsIndex = strpos($this->uri, '?');

        if ($queryParamsIndex === false) {
            $this->uri = substr($this->uri, $branch);
        } else {
            $this->uri = substr($this->uri, $branch, $queryParamsIndex);
        }

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

        $controller->execute();
    }
}
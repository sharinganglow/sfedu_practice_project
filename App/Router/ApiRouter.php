<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\SessionModel;

class ApiRouter extends Router
{
    protected $uri;
    private const CONTROLLER = 2;

    public function runRoute(): void
    {
        SessionModel::getInstance()->start();
        $components = explode('/', $this->uri);
        $controller = $components[self::CONTROLLER];

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Api\\' . $controller . 'Api';

        $controller = class_exists($className) ? new $className : new PageNotFound();
        $controller->execute();
    }
}
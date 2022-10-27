<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\SessionModel;

class ApiRouter extends Router
{
    protected $uri;
    private const CONTROLLER = 2;
    private const INDEX = 3;

    public function runRoute(): void
    {
        SessionModel::getInstance()->start();
        $components = explode('/', $this->uri);
        $controller = $components[self::CONTROLLER];
        $id = $components[self::INDEX] ?? null;

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Api\\' . $controller . 'Api';

        if (class_exists($className)) {
            $controller = new $className($id);
        } else {
            $controller = new PageNotFound();
        }

        $controller->execute();
    }
}
<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\SessionModel;

class ApiRouter extends Router
{
    protected $uri;

    public function runRoute(): void
    {
        SessionModel::getInstance()->start();
        $components = explode('/', $this->uri);
        $controller = $components[2];
        $id = $components[3] ?? null;

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
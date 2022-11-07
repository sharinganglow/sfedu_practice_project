<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\Exceptions\CacheException;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\LoggerModel;
use App\Models\SessionModel;

class ApiRouter extends Router
{
    protected $uri;
    private const CONTROLLER = 2;
    private const INDEX = 3;

    public function runRoute(): void
    {
        $logger = LoggerModel::getInstance();
        SessionModel::getInstance()->start();
        $components = explode('/', $this->uri);
        $controller = $components[self::CONTROLLER];
        $id = $components[self::INDEX] ?? null;

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Api\\' . $controller . 'Api';

        try {
            $controller = class_exists($className) ? new $className($id) : new PageNotFound();
            $controller->execute();

        } catch (\Exception $exception) {
            $logger->setWarning($exception->__toString());
        }
    }
}
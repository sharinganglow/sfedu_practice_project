<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\Exceptions\CacheException;
use App\Models\Exceptions\LogicalException;
use App\Models\Exceptions\ValidationException;
use App\Models\LoggerModel;
use App\Models\SessionModel;

class ConsoleRouter
{
    public function runRoute(array $argv): void
    {
        $logger = LoggerModel::getInstance();
        $controller = $argv[1];
        $fileType = $argv[2] ?? null;

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Console\\' . $controller . 'Console';

        if (!class_exists($className)) {
            $logger->setError('No route');
            throw new LogicalException('No route');
        }

        try {
            $controller = new $className();
            $controller->execute($fileType);
        } catch (\Exception $exception) {
            $logger->setWarning($exception->__toString());
        }
    }
}
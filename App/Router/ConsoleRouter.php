<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\Exceptions\LogicalException;
use App\Models\SessionModel;

class ConsoleRouter
{
    public function runRoute(array $argv): void
    {
        $controller = $argv[1];
        $fileType = $argv[2];

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Console\\' . $controller . 'Console';

        if (class_exists($className)) {
            $controller = new $className();
        } else {
            throw new LogicalException('No route');
        }

        $controller->execute($fileType);
    }
}
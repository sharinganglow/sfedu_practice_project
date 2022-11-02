<?php

namespace App\Router;

use App\Controllers\PageNotFound;
use App\Models\SessionModel;

class ConsoleRouter
{
    public function runRoute(array $argv): void
    {
        SessionModel::getInstance()->start();
        $controller = $argv[1];

        $controller = ucfirst($controller);
        $className = 'App\\Controllers\\Console\\' . $controller . 'Console';

        if (class_exists($className)) {
            $controller = new $className();
        } else {
            $controller = new PageNotFound();
        }

        $controller->execute($argv[2]);
    }
}
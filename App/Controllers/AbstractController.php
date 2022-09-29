<?php

namespace App\Controllers;

use App\Models\Environment\Environment;

abstract class AbstractController
{
    abstract function execute();

    public function getPostParam($name): string
    {
        return htmlspecialchars($_POST[$name]);
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function redirectTo(string $path = ''): void
    {
        $env = Environment::checkInstance();
        header("Location: {$env->getBaseUrl()}{$path}");
        exit();
    }
}

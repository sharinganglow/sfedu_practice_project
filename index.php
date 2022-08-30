<?php

require_once 'vendor/autoload.php';
use App\Router\Router;

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$router = new Router($requestPath);
$router->runRoute();

if (isset($method)) {
    $method->greetUser();
}
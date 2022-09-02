<?php

require_once 'vendor/autoload.php';
use App\Router\Router;

define('APP_ROOT', dirname(__FILE__));

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$router = new Router($requestPath);
$router->runRoute();
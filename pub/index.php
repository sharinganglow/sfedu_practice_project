<?php

use App\Router\Router;

define('APP_ROOT', dirname(__FILE__, 2));

require_once APP_ROOT . '/vendor/autoload.php';

$requestPath = $_SERVER['REQUEST_URI'] ?? '';

$router = new Router($requestPath);
$router->selectController();

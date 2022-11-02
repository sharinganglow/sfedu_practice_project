#!/usr/bin/php
<?php

use App\Router\ConsoleRouter;

define('APP_ROOT', dirname(__FILE__, 2));

require_once APP_ROOT . '/vendor/autoload.php';

$router = new ConsoleRouter();
$router->runRoute($argv);

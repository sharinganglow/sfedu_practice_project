<?php

namespace App\Models;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerModel
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance(): LoggerModel
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setWarning(string $reason): void
    {
        $logger = new Logger('warning');
        $logger->pushHandler(new StreamHandler(
            APP_ROOT . '/var/log/warning.log',
            Logger::WARNING
        ));

        $logger->warning($reason);
    }

    public function setError(string $reason): void
    {
        $logger = new Logger('error');
        $logger->pushHandler(new StreamHandler(
            APP_ROOT . '/var/log/error.log',
            Logger::ERROR
        ));

        $logger->error($reason);
    }
}

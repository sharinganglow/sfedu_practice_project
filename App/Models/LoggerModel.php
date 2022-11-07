<?php

namespace App\Models;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerModel
{
    private static $instance;
    private $logger;

    private function __construct()
    {
        $this->logger = new Logger('issue');

        $this->logger->pushHandler(new StreamHandler(
            APP_ROOT . '/var/log/warning.log',
            Logger::WARNING
        ));

        $this->logger->pushHandler(new StreamHandler(
            APP_ROOT . '/var/log/error.log',
            Logger::ERROR
        ));

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
        $this->logger->warning($reason);
    }

    public function setError(string $reason): void
    {
        $this->logger->error($reason);
    }
}

<?php

namespace App\Models\Environment;

class Environment
{
    private $settings = [];
    private static $instance = null;

    private function __construct()
    {
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
    }

    public static function checkInstance(): Environment
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getBaseUrl(): string
    {
        return $this->settings['LINK']['URI'] ?? '';
    }

    public function getHost(): string
    {
        return $this->settings['DATABASE']['HOST'] ?? '';
    }

    public function getName(): string
    {
        return $this->settings['DATABASE']['NAME'] ?? '';
    }

    public function getUser(): string
    {
        return $this->settings['DATABASE']['USER'] ?? '';
    }

    public function getPassword(): string
    {
        return $this->settings['DATABASE']['PASSWORD'] ?? '';
    }

    public function getCharset(): string
    {
        return $this->settings['DATABASE']['CHARSET'] ?? '';
    }
}
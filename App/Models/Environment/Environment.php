<?php

namespace App\Models\Environment;

class Environment
{
    private $settings = [];
    protected $uri = [];
    protected $database = [];
    private static $instance = null;

    private function __construct()
    {
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
        $this->uri = $this->settings['LINK']['URI'];
        $this->database = $this->settings['DATABASE'];
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
        return $this->uri ?? '';
    }

    public function getHost(): string
    {
        return $this->database['HOST'] ?? '';
    }

    public function getName(): string
    {
        return $this->database['NAME'] ?? '';
    }

    public function getUser(): string
    {
        return $this->database['USER'] ?? '';
    }

    public function getPassword(): string
    {
        return $this->database['PASSWORD'] ?? '';
    }

    public function getCharset(): string
    {
        return $this->database['CHARSET'] ?? '';
    }
}
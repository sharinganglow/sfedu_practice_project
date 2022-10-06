<?php

namespace App\Models\Environment;

class Environment
{
    private $settings = [];
    protected $linkSettings = [];
    protected $databaseSettings = [];
    private static $instance = null;

    private function __construct()
    {
        $this->settings = parse_ini_file(APP_ROOT . '/.env', true);
        $this->linkSettings = $this->settings['LINK'] ?? '';
        $this->databaseSettings = $this->settings['DATABASE'] ?? '';
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
        return $this->linkSettings['URI'] ?? '';
    }

    public function getHost(): string
    {
        return $this->databaseSettings['HOST'] ?? '';
    }

    public function getName(): string
    {
        return $this->databaseSettings['NAME'] ?? '';
    }

    public function getUser(): string
    {
        return $this->databaseSettings['USER'] ?? '';
    }

    public function getPassword(): string
    {
        return $this->databaseSettings['PASSWORD'] ?? '';
    }

    public function getCharset(): string
    {
        return $this->databaseSettings['CHARSET'] ?? '';
    }
}
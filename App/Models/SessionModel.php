<?php

namespace App\Models;

class SessionModel
{
    private static $instance = null;

    private function __construct()
    {
        session_save_path(APP_ROOT . '/var/session');
    }

    public static function getInstance(): SessionModel
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function start(): self
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $this;
    }

    public function destroy(): void
    {
        session_destroy();
        $_SESSION['client'] = [];
    }

    public function setClientId(int $id): self
    {
        $_SESSION['client']['id'] = $id;
        return $this;
    }

    public function getClientId(): ?int
    {
        return $_SESSION['client']['id'] ?? null;
    }

    public function setCsrfToken(string $token): self
    {
        $_SESSION['client']['token'] = $token;
        return $this;
    }

    public function getCsrfToken(): ?string
    {
        return $_SESSION['client']['token'] ?? null;
    }
}
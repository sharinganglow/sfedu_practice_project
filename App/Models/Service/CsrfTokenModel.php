<?php

namespace App\Models\Service;

class CsrfTokenModel
{
    public function generateCsrfToken(): string
    {
        return hash('sha256', random_bytes(20));
    }
}
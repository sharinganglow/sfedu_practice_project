<?php

namespace App\Models\Entity;

class CsrfTokenModel extends Model
{
    public function generateCsrfToken(): string
    {
        return hash('sha256', random_bytes(20));
    }
}
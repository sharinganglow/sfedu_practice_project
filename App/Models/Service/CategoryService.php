<?php

namespace App\Models\Service;

class CategoryService
{
    public function glue(array $categories, $delimiter = ','): string
    {
        return implode($delimiter, array_column($categories, 'name'));
    }
}
<?php

namespace App\Controllers;

class Brand
{
    private $data;

    public function greetUser() :void
    {
        echo ' Hello there, this is brand page';
    }

    public function getData() :array
    {
        return $this->data;
    }

    public function setData($value)
    {
        $this->data = [
            'brand' => 'Apple', 'Samsung', 'Bea(e)r'
        ];
    }
}
<?php

namespace App\Controllers;

class Country
{
    private $data;

    public function greetUser() :void
    {
        echo ' Hello there, this is county page';
    }

    public function getData() :array
    {
        return $this->data;
    }

    public function setData() :void
    {
        $this->data = [
            'country' => 'Serbia', 'China', 'Russia'
        ];
    }
}
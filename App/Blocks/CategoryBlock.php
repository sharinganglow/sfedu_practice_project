<?php

namespace App\Blocks;

class CategoryBlock
{
    public function render()
    {
        require APP_ROOT . '/views/category.phtml';
    }

    public function getData() :array
    {
        return $data = [
            'category' => 'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                          'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                          'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
                          'smartphone', 'ios', 'android', 'supersmartphone', 'linux',
        ];
    }

    public function setData() :void
    {

    }
}
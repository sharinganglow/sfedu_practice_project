<?php

namespace App\Blocks;

class OrderBlock
{
    public function render()
    {
        require APP_ROOT . '/views/order.phtml';
    }

    public function getData() :array
    {
        return $data = [
            'total' => '13004', '89999', '100000',
        ];
    }

    public function setData() :void
    {

    }
}
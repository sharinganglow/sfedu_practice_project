<?php

namespace App\Blocks;

class ClientBlock
{
    public function render()
    {
        require APP_ROOT . '/views/client.phtml';
    }

    public function getData() :array
    {
        return $data = [
            [
                'name'      => 'Dimogordon',
                'surname'   => 'Wecooking',
                'email'     => 'wecooking@gmail.com',
            ],
            [
                'name'      => 'Sasw',
                'surname'   => 'Butko',
                'email'     => 'butko@gmail.com',
            ],
            [
                'name'      => 'Alister',
                'surname'   => 'KFC',
                'email'     => 'twister@gmail.com'
            ]
        ];
    }

    public function setData() :void
    {

    }
}
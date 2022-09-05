<?php

namespace App\Blocks;

class ClientBlock extends AbstractBlockHandler
{
    private $layout = APP_ROOT . '/views/client.phtml';

    public function render()
    {
        $header = new HeaderBlock(5);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/constituents/main-template.phtml';
    }

    public function getData(): array
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
}
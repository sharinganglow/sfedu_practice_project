<?php

namespace App\Blocks;

class OrderBlock extends AbstractBlockHandler
{
    private $layout = APP_ROOT . '/views/order.phtml';

    public function render()
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/constituents/main-template.phtml';
    }

    public function getData(): array
    {
        return $data = ['13004', '89999', '100000',];
    }
}
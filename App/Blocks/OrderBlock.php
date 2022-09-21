<?php

namespace App\Blocks;

use App\Database\Database;
use App\Models\OrderModel;

class OrderBlock extends AbstractBlockHandler
{
    protected $data;
    private $template = APP_ROOT . '/views/order.phtml';

    public function render()
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
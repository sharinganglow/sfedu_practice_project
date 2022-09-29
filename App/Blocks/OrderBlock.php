<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\OrderResourceModel;

class OrderBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/order.phtml';

    public function render($order)
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $model = $order;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
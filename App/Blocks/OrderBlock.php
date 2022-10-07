<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\OrderResourceModel;

class OrderBlock extends Block
{
    protected $data;
    protected $template = 'order.phtml';

    public function render($order)
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $model = $order;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
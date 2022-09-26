<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\OrderResourceModel;

class OrderBlock extends AbstractBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/order.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
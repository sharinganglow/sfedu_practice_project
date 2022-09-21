<?php

namespace App\Blocks;

use App\Database\Database;

class ClientBlock extends AbstractBlockHandler
{
    protected $data;
    private $template = APP_ROOT . '/views/client.phtml';

    public function render()
    {
        $header = new HeaderBlock(5);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
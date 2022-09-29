<?php

namespace App\Blocks;

use App\Models\ClientModel;
use App\Models\Database;

class ClientBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/client.phtml';

    public function render($client)
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(5);
        $footer = new FooterBlock();
        $model = $client;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
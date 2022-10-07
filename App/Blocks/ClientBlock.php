<?php

namespace App\Blocks;

use App\Models\ClientModel;
use App\Models\Database;

class ClientBlock extends Block
{
    protected $data;
    protected $template = 'client.phtml';

    public function render($client)
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(5);
        $footer = new FooterBlock();
        $model = $client;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
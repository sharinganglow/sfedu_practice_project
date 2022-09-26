<?php

namespace App\Blocks;

use App\Models\ClientModel;
use App\Models\ClientsModel;
use App\Models\Database;

class ClientBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/client.phtml';

    public function render($clientsList)
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(5);
        $footer = new FooterBlock();
        $model = $clientsList;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
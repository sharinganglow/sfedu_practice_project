<?php

namespace App\Blocks;

class StorageBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/storage.phtml';

    public function render($storage)
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(3);
        $footer = new FooterBlock();
        $model = $storage;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
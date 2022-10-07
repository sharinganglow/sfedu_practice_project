<?php

namespace App\Blocks;

class StorageBlock extends Block
{
    protected $data;
    protected $template = 'storage.phtml';

    public function render($storage)
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(3);
        $footer = new FooterBlock();
        $model = $storage;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
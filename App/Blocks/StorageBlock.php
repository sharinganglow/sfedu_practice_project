<?php

namespace App\Blocks;

use App\Models\Entity\StorageModel;

class StorageBlock extends Block
{
    protected $data;
    protected $template = 'storage.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(3);
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
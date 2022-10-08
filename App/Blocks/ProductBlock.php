<?php

namespace App\Blocks;

use App\Models\Entity\ProductModel;
use App\Models\Resource\CategoryResourceModel;

class ProductBlock extends Block
{
    protected $data;
    protected $template = 'product.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(2);
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
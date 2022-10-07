<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;

class ProductBlock extends Block
{
    protected $data;
    protected $template = 'product.phtml';

    public function render($product)
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(2);
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();
        $model = $product;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
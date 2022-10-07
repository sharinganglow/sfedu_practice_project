<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnitBlock extends Block
{
    protected $data;
    protected $template = 'productUnit.phtml';

    public function render($product)
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();
        $model = $product;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
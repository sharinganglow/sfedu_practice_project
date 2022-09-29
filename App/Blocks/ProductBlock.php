<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;

class ProductBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/product.phtml';

    public function render($product)
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(2);
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();
        $model = $product;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
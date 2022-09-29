<?php

namespace App\Blocks;

use App\Blocks\AbstractBlock;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnitBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/productUnit.phtml';

    public function render($product)
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();
        $model = $product;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
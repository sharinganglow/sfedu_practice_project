<?php

namespace App\Blocks;

use App\Blocks\AbstractBlock;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnitBlock extends AbstractBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/productUnit.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $product = new ProductResourceModel();
        $category = new CategoryResourceModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
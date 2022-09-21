<?php

namespace App\Blocks;

use App\Blocks\AbstractBlockHandler;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductUnitBlock extends AbstractBlockHandler
{
    protected $data;
    private $template = APP_ROOT . '/views/productUnit.phtml';

    public function render()
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();
        $product = new ProductModel();
        $category = new CategoryModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
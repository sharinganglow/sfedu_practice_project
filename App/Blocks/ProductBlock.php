<?php

namespace App\Blocks;

use App\Models\CategoryModel;

class ProductBlock extends AbstractBlockHandler
{
    protected $data;
    private $template = APP_ROOT . '/views/product.phtml';

    public function render()
    {
        $header = new HeaderBlock(2);
        $footer = new FooterBlock();
        $category = new CategoryModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
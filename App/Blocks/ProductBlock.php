<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;

class ProductBlock extends AbstractBlock
{
    protected $data;
    private $template = APP_ROOT . '/views/product.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(2);
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ProductResourceModel;

class DeleteEntityBlock
{
    private $template = APP_ROOT . '/views/deleteEntity.phtml';

    public function render($product): void
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();
        $category = new CategoryResourceModel();
        $deleteAccept = new ProductResourceModel();
        $model = $product;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
<?php

namespace App\Blocks;

use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ProductResourceModel;

class ProductUnitBlock extends Block
{
    protected $data;
    protected $template = 'productUnit.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
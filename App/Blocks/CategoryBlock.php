<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class CategoryBlock extends Block
{
    protected $template = 'category.phtml';

    public function render($category)
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(4);
        $footer = new FooterBlock();
        $model = $category;

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
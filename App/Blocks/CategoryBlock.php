<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class CategoryBlock
{
    private $template = APP_ROOT . '/views/category.phtml';

    public function render($category)
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(4);
        $footer = new FooterBlock();
        $model = $category;

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
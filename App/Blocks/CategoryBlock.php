<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Resource\CategoryResourceModel;

class CategoryBlock extends AbstractBlock
{
    private $template = APP_ROOT . '/views/category.phtml';

    public function render()
    {
        $header = new HeaderBlock();
        $header->setFocusedLink(4);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
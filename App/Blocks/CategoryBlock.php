<?php

namespace App\Blocks;

use App\Database\Database;
use App\Models\CategoryModel;

class CategoryBlock extends AbstractBlockHandler
{
    private $template = APP_ROOT . '/views/category.phtml';

    public function render()
    {
        $header = new HeaderBlock(4);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }
}
<?php

namespace App\Blocks;

use App\Models\Database;
use App\Models\Entity\CategoryModel;
use App\Models\Resource\CategoryResourceModel;

class CategoryBlock extends Block
{
    protected $template = 'category.phtml';
    protected $data = [];

    public function render()
    {
        $header = new HeaderBlock();
        $header->setUnderlinedLink(4);
        $footer = new FooterBlock();

        require_once "{$this->getPath()}components/layout.phtml";
    }
}
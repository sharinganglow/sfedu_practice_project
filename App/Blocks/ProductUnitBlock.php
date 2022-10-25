<?php

namespace App\Blocks;

use App\Models\Entity\Model;
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

    public function setProduct(Model $model): Block
    {
        $this->model = $model;
        return $this;
    }

    public function getProduct(): Model
    {
        return $this->model;
    }
}
<?php

namespace App\Blocks;

use App\Models\Entity\Model;

class EditProductBlock extends Block
{
    protected $template = 'edit-product.phtml';

    public function render(): void
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
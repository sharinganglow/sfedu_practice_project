<?php

namespace App\Blocks;

class ProductBlock extends AbstractBlockHandler
{
    private $data;
    private $template = APP_ROOT . '/views/product.phtml';

    public function render()
    {
        $header = new HeaderBlock(2);
        $footer = new FooterBlock();
        $category = new CategoryBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

//    public function getHierarchy($id): string
//    {
//        $result = '';
//        foreach ($this->data as $item) {
//            if ($this->data['product_id'] == $id) {
//                $result .= ', ' . $this->data['category_name'];
//            }
//        }
//        return $result;
//    }
}
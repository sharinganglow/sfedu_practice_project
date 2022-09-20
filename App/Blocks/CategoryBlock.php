<?php

namespace App\Blocks;

use App\Database\Database;

class CategoryBlock extends AbstractBlockHandler
{
    private $data;
    private $template = APP_ROOT . '/views/category.phtml';

    public function render()
    {
        $header = new HeaderBlock(4);
        $footer = new FooterBlock();

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

    public function getAllCategories($productId): array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT t1.name FROM category AS t1 JOIN categories_of_products AS t2 
                    ON (t1.id=t2.category_id) JOIN product AS t3 ON (t2.product_id=t3.id) 
                     WHERE t3.id = ?;'
        );
        $query->execute([$productId]);
        return $query->fetchAll();
    }
}
<?php

namespace App\Blocks;

use App\Database\Database;

class OrderBlock extends AbstractBlockHandler
{
    private $data;
    private $template = APP_ROOT . '/views/order.phtml';

    public function render()
    {
        $header = new HeaderBlock(0);
        $footer = new FooterBlock();

        require_once APP_ROOT . '/views/components/layout.phtml';
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData($id) :self
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT _order.total, product.name, _order.id AS order_id FROM _order JOIN order_item 
                    ON (order_item.id=_order.id) JOIN product ON (order_item.product_id=product.id)
                    WHERE order_id = ?;'
        );
        $query->execute([$id]);

        $this->data = $query->fetchAll();
        return $this;
    }
}
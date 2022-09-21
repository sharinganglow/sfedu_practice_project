<?php

namespace App\Models;

use App\Database\Database;

class OrderModel
{
    public function initOrder($id) :array
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT _order.total, product.name, _order.id AS order_id FROM _order JOIN order_item 
                    ON (order_item.id=_order.id) JOIN product ON (order_item.product_id=product.id)
                    WHERE order_id = ?;'
        );
        $query->execute([$id]);

        return $query->fetchAll();
    }
}
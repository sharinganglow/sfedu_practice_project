<?php

namespace App\Models\Resource;

use App\Models\Database;
use App\Models\Entity\CategoryModel;
use App\Models\Entity\Model;
use App\Models\Entity\OrderModel;

class OrderResourceModel
{
    public function initOrder($id): Model
    {
        $connection = Database::getConnection();
        $query = $connection->prepare(
            'SELECT _order.total, product.name, _order.id AS order_id FROM _order JOIN order_item 
                    ON (order_item.id=_order.id) JOIN product ON (order_item.product_id=product.id)
                    WHERE order_id = ?;'
        );
        $query->execute([$id]);
        $data = $query->fetch();

        return $data ? $this->buildItem($data) : $this->buildEmptyItem();
    }

    protected function buildItem(array $data): OrderModel
    {
        return $this->buildEmptyItem()
            ->setName($data['name'] ?? '')
            ->setTotal($data['total'] ?? 0);
    }

    protected function buildEmptyItem(): OrderModel
    {
        return new OrderModel();
    }
}
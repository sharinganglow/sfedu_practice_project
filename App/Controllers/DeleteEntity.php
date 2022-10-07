<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Exceptions\LogicalException;
use App\Models\Resource\ProductResourceModel;

class DeleteEntity extends AbstractController
{
    public function execute()
    {
        try {
            $productResource = new ProductResourceModel();
            $productResource->deleteEntity($this->getIDParam());
            $this->redirectTo('product');
        } catch (LogicalException $exception) {
            throw new LogicalException('Ошибка при удалении записи' . PHP_EOL);
        }
    }
}
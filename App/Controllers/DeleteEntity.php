<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProjectException\ProjectException;
use App\Models\Resource\ProductResourceModel;

class DeleteEntity extends AbstractController
{
    public function execute()
    {
        try {
            $productResource = new ProductResourceModel();
            $productResource->deleteEntity($this->getIDParam());
            $this->redirectTo('product');
        } catch (ProjectException $exception) {
            throw new ProjectException('Ошибка при удалении записи' . PHP_EOL);
        }
    }
}
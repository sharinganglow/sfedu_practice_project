<?php

namespace App\Controllers;

use App\Blocks\AddProductBlock;
use App\Blocks\EditProductBlock;
use App\Blocks\ProductUnitBlock;
use App\Models\Entity\ProductModel;
use App\Models\Entity\ProductsModel;
use App\Models\Entity\ValidationModel;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\CsrfTokenModel;
use App\Models\SessionModel;

class EditProduct extends AbstractController
{
    public function execute()
    {
        if ($this->getRequestMethod() == 'GET') {
            $token = new CsrfTokenModel();
            SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());
            $productUnitResource = new ProductResourceModel();
            $productsList = new ProductsModel();
            $productsList->setProduct($productUnitResource->getProductById($this->getIdParam()));

            $block = new EditProductBlock();
            $block
                ->setModel($productsList)
                ->render();
        } else {
            $this->editProduct();
            $this->redirectTo('product');
        }
    }

    public function editProduct(): void
    {
        $validation = new ValidationModel();
        $validation->verifyToken($this->getCsrfToken());

        $this->executeProductEdition($this->getInputParams(), $this->getIdParam());
    }
}
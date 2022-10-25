<?php

namespace App\Controllers;

use App\Blocks\AddProductBlock;
use App\Blocks\EditProductBlock;
use App\Blocks\ProductUnitBlock;
use App\Models\Entity\ProductModel;
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
        if ($this->getRequestMethod() === 'GET') {
            $this->executeGetProductForm('edit');
        } else {
            $this->editProduct();
            $this->redirectTo('product');
        }
    }

    public function editProduct(): void
    {
        $validation = new ValidationModel();
        $validation->verifyToken($this->getCsrfToken());

        $product = new ProductModel();
        $product->executeProductEdition($this->getInputParams(), $this->getIdParam());
    }
}
<?php

namespace App\Controllers;

use App\Blocks\AddClientBlock;
use App\Blocks\EditProfileBlock;
use App\Models\Entity\ValidationModel;
use App\Models\Environment\Environment;
use App\Models\Exceptions\ValidationException;
use App\Models\Resource\BrandResourceModel;
use App\Models\Resource\CategoryResourceModel;
use App\Models\Resource\ClientResourceModel;
use App\Models\Resource\CountryResourceModel;
use App\Models\Resource\ProductResourceModel;
use App\Models\Service\CsrfTokenModel;
use App\Models\SessionModel;

abstract class AbstractController
{
    abstract function execute();

    public function getPostParam($name): string
    {
        return htmlspecialchars($_POST[$name]);
    }

    public function getInputParams(): ?array
    {
        return ($_POST) ?? null;
    }

    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getIdParam(): string
    {
        return $_GET['id'] ?? '';
    }

    public function getCsrfToken(): string
    {
        return $_POST['csrf_token'] ?? '';
    }

    public function redirectTo(string $path): void
    {
        $env = Environment::checkInstance();
        header("Location: {$env->getBaseUrl()}{$path}");
        exit();
    }

    public function executeGetForm(string $type): void
    {
        $token = new CsrfTokenModel();
        SessionModel::getInstance()->setCsrfToken($token->generateCsrfToken());

        if ($type == 'edit') {
            $block = new EditProfileBlock();
        } else {
            $block = new AddClientBlock();
        }

        $block->render();
    }

    public function executePostForm(string $type): void
    {
        $validation = new ValidationModel();
        $model = new ClientResourceModel();
        $isFormAccepted = $validation->isInputValid($this->getInputParams());

        if (!$isFormAccepted) {
            throw new ValidationException('Ошибка при добавлении пользователя');
        }
        $validation->verifyToken($this->getCsrfToken());
        $protectedPass = $model->hashPassword($this->getPostParam('password'));

        if ($type == 'edit') {
            $model->editProfile(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $protectedPass
            );
        } else {
            $model->addClient(
                $this->getPostParam('name'),
                $this->getPostParam('surname'),
                $this->getPostParam('email'),
                $protectedPass
            );
        }
    }

    public function executeProductEdition($data, $id): void
    {
        $brandResource = new BrandResourceModel();
        $countryResource = new CountryResourceModel();
        $categoryResource = new CategoryResourceModel();
        $productResource = new ProductResourceModel();

        if (!$brandResource->checkIfExist($data['brand'])) {
            $brandResource->addBrand($data['brand']);
        }
        $brand = $brandResource->getRowByColumn('brand', $data['brand'])[0];

        if (!$countryResource->checkIfExist($data['country'])) {
            $countryResource->addCountry($data['country']);
        }
        $country = $countryResource->getRowByColumn('country', $data['country'])[0];
        $productResource->editProduct(
            $data['name'], $data['price'],
            $country['id'], $brand['id'],
            $data['date'], $id
        );
        $product = $productResource->getRowByColumn('name', $data['name'])[0];

        $categories = explode(',', $data['category']);
        $categoryResource->clearCategories($product['id']);
        foreach ($categories as $item) {
            if (!$categoryResource->checkIfExist($item)) {
                $categoryResource->addCategory($item, $data['date']);
            }
            $category = $categoryResource->getRowByColumn('name', $item)[0];
            $categoryResource->tieWithProduct($product['id'], $category['id']);
        }
    }

    public function executeProductAddition($data): void
    {
        $brandResource = new BrandResourceModel();
        $countryResource = new CountryResourceModel();
        $categoryResource = new CategoryResourceModel();
        $productResource = new ProductResourceModel();

        $brandResource->addBrand($data['brand']);
        $countryResource->addCountry($data['country']);

        $country = $countryResource->getRowByColumn('country', $data['country'])[0];
        $brand = $brandResource->getRowByColumn('brand', $data['brand'])[0];
        $productResource->addProduct($data['name'], $data['price'], $country['id'], $brand['id'], $data['date']);
        $product = $productResource->getRowByColumn('name', $data['name'])[0];

        $categories = explode(',', $data['category']);
        foreach ($categories as $item) {
            $categoryResource->addCategory($item, $data['date']);
            $category = $categoryResource->getRowByColumn('name', $item)[0];
            $categoryResource->tieWithProduct($product['id'], $category['id']);
        }
    }
}

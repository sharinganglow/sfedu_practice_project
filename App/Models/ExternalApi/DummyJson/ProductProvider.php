<?php

namespace App\Models\ExternalApi\DummyJson;

use App\Models\Resource\ProductResourceModel;
use App\Models\Service\ProductService;
use GuzzleHttp\Client;

class ProductProvider
{
    public function importData(): void
    {
        $resource = 'https://dummyjson.com/products';
        $client = new Client();

        $result = $client->get($resource);
        $data = json_decode($result->getBody(), true);
        $products = $data['products'];

        foreach ($products as $product) {
            $needle = [
                'name'          => $product['title'] ?? '',
                'price'         => (int) $product['price'] ?? null,
                'country'       => null,
                'brand'         => $product['brand'] ?? '',
                'date'          => null,
                'category'      => $product['category'],
            ];

            $model = new ProductResourceModel();
            $id = $model->getProductId('name', $product['title']);
            $service = new ProductService();

            if ($id === null) {
                $service->add($needle);
            } else {
                $service->edit($needle, $id);
            }
        }
    }
}

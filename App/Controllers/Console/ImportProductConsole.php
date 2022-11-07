<?php

namespace App\Controllers\Console;

use App\Models\ExternalApi\DummyJson\ProductProvider;
use App\Models\Service\ProductService;
use GuzzleHttp\Client;

class ImportProductConsole
{
    public function execute(): void
    {
        $provider = new ProductProvider();
        $provider->importData();
    }
}
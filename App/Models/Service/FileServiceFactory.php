<?php

namespace App\Models\Service;

use App\Models\Exceptions\FileHandleException;

class FileServiceFactory
{
    public function getObject($method, $path): FileSystemService
    {
        $cacheMap = [
            'csv' => CsvService::class,
            'xlsx' => XlsxHandler::class
        ];

        $file = new $cacheMap[$method]($path) ?? null;
        if (!$file) {
            throw new FileHandleException('Неверно указан тип файла (csv | xlsx)');
        }

        return $file;
    }
}
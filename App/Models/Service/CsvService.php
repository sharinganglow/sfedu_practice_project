<?php

namespace App\Models\Service;

class CsvService extends FileSystemService
{
    protected $path;

    public function handle(AbstractService $model, string $fileName): void
    {
        $stream = fopen($this->getPath() . '/' . $fileName, 'w+');

        fputcsv($stream, $model->getKeys());
        foreach ($model->getAll() as $row) {
            fputcsv($stream, $row);
        }
        fclose($stream);

        $this->checkResult($fileName);
    }
}
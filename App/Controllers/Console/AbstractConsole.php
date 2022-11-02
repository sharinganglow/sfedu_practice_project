<?php

namespace App\Controllers\Console;

use App\Models\Exceptions\LogicalException;
use App\Models\Service\AbstractService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

abstract class AbstractConsole
{
    abstract public function execute($method);

    public function setLocation($newPath, $fileName): self
    {
        $this->path = $newPath . $fileName;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->path ?? null;
    }

    protected function checkIfFail(): void
    {
        if (!file_exists($this->getLocation())) {
            throw new LogicalException('Не удалось создать файл');
        }
        echo 'Complete!' . PHP_EOL;
    }

    function clearDirectory($dir): void
    {
        $list = scandir(APP_ROOT . $dir);
        unset($list[0], $list[1]);

        foreach ($list as $file)
        {
            if (is_dir($dir.$file))
            {
                $this->clearDirectory($dir.$file.'/');
                rmdir($dir.$file);
            } else {
                unlink(APP_ROOT . $dir.$file);
            }
        }
    }

    protected function formatTable(object $worksheet): void
    {
        $worksheet->getColumnDimension('A')->setWidth(15);
        $worksheet->getColumnDimension('B')->setWidth(10);
        $worksheet->getColumnDimension('C')->setWidth(8);
        $worksheet->getColumnDimension('D')->setWidth(20);
        $worksheet->getColumnDimension('E')->setWidth(15);
        $worksheet->getColumnDimension('F')->setWidth(25);
    }

    public function handleCsv(AbstractService $model): void
    {
        $stream = fopen($this->getLocation(), 'w+');

        fputcsv($stream, $model->getKeys());
        foreach ($model->getAll() as $row) {
            fputcsv($stream, $row);
        }
        fclose($stream);

        $this->checkIfFail();
    }

    public function handleXlsx(AbstractService $model): void
    {
        $data = $model->getAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $this->formatTable($sheet);

        $sheet->setTitle('Workssheet 1');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        array_unshift($data, $model->getKeys());

        $sheet->fromArray($data);
        $writer->save($this->getLocation());

        $this->checkIfFail();
    }
}
<?php

namespace App\Models\Service;

use App\Models\Exceptions\LogicalException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FileSystemService
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    protected function checkResult($fileName): void
    {
        if (!file_exists($this->getPath() . '/' . $fileName)) {
            throw new LogicalException('Не удалось создать файл');
        }
    }

    public function clearDirectory($dir): void
    {
        $list = scandir($dir);
        $currentDir = array_search('.', $list);
        $prevDir = array_search('..', $list);
        unset($list[$currentDir], $list[$prevDir]);

        foreach ($list as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $this->clearDirectory($path);
                rmdir($path);
            } else {
                unlink($path);
            }
        }
    }
}
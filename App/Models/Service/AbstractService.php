<?php

namespace App\Models\Service;

abstract class AbstractService
{
    abstract public function getUnit(int $id);

    abstract public function getAll();
}
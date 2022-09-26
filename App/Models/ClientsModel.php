<?php

namespace App\Models;

class ClientsModel
{
    protected $clients = [];

    public function addClient($row): void
    {
        $this->clients[] = $row;
    }

    public function getData(): array
    {
        return $this->clients;
    }
}
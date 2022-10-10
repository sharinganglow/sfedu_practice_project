<?php

namespace App\Models\Entity;

class ClientsModel extends Model
{
    public function setClient($row): self
    {
        $client = new ClientModel();
        $client->setName($row['name']);
        $client->setSurname($row['surname']);
        $client->setEmail($row['email']);
        $client->setPassword($row['password']);
        $client->setId($row['id']);

        $this->data [] = $client;
        return $this;
    }
}
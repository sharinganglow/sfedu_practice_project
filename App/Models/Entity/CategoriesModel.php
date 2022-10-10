<?php

namespace App\Models\Entity;

class CategoriesModel extends Model
{
    protected $data = [];

    public function setCategory($row): self
    {
        $category = new CategoryModel();
        $category->setCategory($row['name']);

        $this->data [] = $category;
        return $this;
    }
}
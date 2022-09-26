<?php

namespace App\Models;

class Model
{
    protected $data = [];

    public function __construct()
    {
        if (isset($this->rows)) {

            foreach ($this->rows as $row) {
                $row = strtolower($row);
                $this->data[($row)] = false;
            }
        } else {
            throw new \Exception('Не удалось записать поле');
        }
    }

    public function __call($name, $arguments)
    {
        $handleType = substr($name, 0, 3);
        $fieldName = strtolower(substr($name, 3));

        if ($handleType == 'set') {
            if (isset($this->data[$fieldName]) && $this->data[$fieldName] === false) {
                $this->data[$fieldName] = $arguments[0];
                return null;
            }

            throw new \Exception("Ошибка при выставлении значения $fieldName.
            Попробуйте воспользоваться командой addNewColumn для инициализации новой колонки данных");
        }

        if ($handleType == 'get') {

            if (isset($this->data[$fieldName])) {
                return $this->data[$fieldName];
            }

            throw new \Exception("Ошибка при получении значения $fieldName");
        }

        throw new \Exception('Неверно введена команда доступа');
    }

    public function addNewColumn($column)
    {
        $column = strtolower($column);
        $this->data[$column] = false;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
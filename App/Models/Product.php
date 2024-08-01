<?php

namespace App\Models;

use App\Core\DB;

abstract class Product
{

    protected $sku, $name, $price, $attribute, $type;
    protected static $table = "products";
    protected $errors = false;
    public $isUniqueSku = false;

    public static $types = [
        "DVD",
        "Book",
        "Furniture",
    ];

    abstract public function validateAttribute();

    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    public function getSku()
    {
        return $this->sku;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public static function get()
    {
        return (new DB())->setTable(static::$table)->select()->getResult();
    }
    public function save()
    {
        return (new DB())->setTable(static::$table)->insert([
            "name" => $this->name,
            "sku" => $this->sku,
            "price" => $this->price,
            "attribute" => $this->attribute,
        ])->getResult();
    }

    public static function delete(array $ids)
    {
        return (new DB())->setTable(static::$table)->deleteMultiple($ids);
    }

    public function uniqueSku($sku)
    {
        return (new DB())->setTable(static::$table)->where(["sku" => $sku])->select()->getResult();
    }
    public function getAttribute()
    {
        return '';
    }

    protected function validatePrice()
    {
        if (!is_numeric($this->price)) {
            $this->errors = true;
        }
    }
    protected function validateName()
    {
        if (empty($this->name) | !is_string($this->name)) {
            $this->errors = true;
        }

    }

}

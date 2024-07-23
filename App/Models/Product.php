<?php

namespace App\Models;

use App\Core\DB;

abstract class Product
{

    protected $sku, $name, $price, $attribute, $type;
    protected static $table = "products";
    public $errors = false;
    public static $types = [
        "DVD",
        "Book",
        "Furniture",
    ];
    function __construct($name, $sku, $price)
    {
        $this->setName($name);
        $this->setSku($sku);
        $this->setPrice($price);


    }
    abstract public function validateAttribute();
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setSku($sku)
    {
        $this->sku = $sku;
    }
    public function getSku()
    {
        return $this->sku;
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

    public function uniqueSku()
    {
        return (new DB())->setTable(static::$table)->where(["sku" => $this->getSku()])->getResult();
    }
    public function getAttribute()
    {
        return '';
    }
    protected function validateRequired()
    {
        $this->validateName();
        $this->validateSku();
        $this->validatePrice();
        $this->validateAttribute();
    }

    private function validatePrice()
    {
        if ($this->getPrice() <= 0) {
            $this->errors = true;
        }
    }
    private function validateName()
    {
        if (empty($this->getName()) || !is_string($this->getName())) {
            $this->errors = true;
        }
    }
    private function validateSku()
    {
        if (empty($this->getSku()) || !empty($this->uniqueSku())) {
            $this->errors = true;
        }
    }

   



}

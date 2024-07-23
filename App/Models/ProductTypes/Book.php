<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class Book extends Product
{

    private $weight;
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $$key = trim(htmlspecialchars($value));
        }
        parent::__construct($name, $sku, $price);
        $this->setWeight($weight);
        $this->validateRequired();
        $this->getAttribute();
    }
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getWeight()
    {
        return $this->weight;
    }
  
    public function getAttribute()
    {
        $this->attribute = "Weight:{$this->getWeight()} kg";

    }
    public function validateAttribute()
    {
        $this->validateWeight();
    }

    private function validateWeight()
    {
        if (empty($this->getWeight()) || !is_numeric($this->getWeight())) {
            parent::$errors = true;
        }
    }

}

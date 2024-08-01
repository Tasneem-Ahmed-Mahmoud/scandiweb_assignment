<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class Book extends Product
{

    private $weight;
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
        $this->attribute = "Weight:{$this->weight} kg";

    }

    private function validateWeight()
    {
        if (!is_numeric($this->weight)) {
            $this->errors = true;
        }
    }

    public function validateAttribute()
    {
        $this->validateName();
        $this->validatePrice();
        $this->validateWeight();
        return $this->errors;

    }

}

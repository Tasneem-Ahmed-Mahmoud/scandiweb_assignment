<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class DVD extends Product
{
    private $size;
    
    public function setSize($size)
    {
        $this->size = $size;
    }
    public function getSize()
    {
        return $this->size;
    }

    public function getAttribute()
    {
        $this->attribute = "Size: {$this->getSize()} MB";
    }
  
    public function validateAttribute()
    {
        $this->validateName();
        $this->validatePrice();
        $this->validateSize();
        return $this->errors;

    }
    private function validateSize()
    {
        if (!is_numeric($this->size)) {
           $this->errors = true;
        }
    }
}

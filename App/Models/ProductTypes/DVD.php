<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class DVD extends Product
{
    private $size;
    function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $$key = trim(htmlspecialchars($value));
        }
        parent::__construct($name, $sku, $price);
        $this->setSize($size);
        $this->getAttribute();
        $this->validateRequired();
    }

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
        $this->validateSize();

    }
    private function validateSize()
    {
        if (empty($this->getSize()) || !is_numeric($this->getSize())) {
            parent::$errors = true;
        }
    }
}

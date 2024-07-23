<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class Furniture extends Product
{
    private $height, $width, $length;
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $$key = trim(htmlspecialchars($value));
        }
        parent::__construct($name, $sku, $price);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setLength($length);
        $this->getAttribute();
        $this->validateRequired();

    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setWidth($width)
    {

        $this->width = $width;
    }

    public function setLength($length)
    {

        $this->length = $length;

    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getAttribute()
    {
       $this->attribute = "dimension:{$this->getHeight()} x {$this->getWidth()} x {$this->getLength()} ";
    }

    
    public function validateAttribute()
    {
        $this->validatedHeight();
        $this->validatedWidth();
        $this->validatedLength();

    }

    private function validatedWidth()
    {
        if ($this->getWidth() <= 0) {
            $this->errors = true;
        }
    }
    private function validatedHeight()
    {
        if ($this->getHeight() <= 0) {
            $this->errors = true;
        }
    }

    private function validatedLength()
    {
        if ($this->getLength() <= 0) {
            $this->errors = true;
        }
    }

}

<?php

namespace App\Models\ProductTypes;

use App\Models\Product;

class Furniture extends Product
{
    private $height, $width, $length;

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

    private function validatedWidth()
    {
        if (!is_numeric($this->getWidth())) {
            $this->errors = true;
        }
    }
    private function validatedHeight()
    {
        if (!is_numeric($this->height)) {
            $this->errors = true;
        }
    }

    private function validatedLength()
    {
        if (!is_numeric($this->length)) {
            $this->errors = true;
        }
    }

    public function validateAttribute()
    {
        $this->validateName();
        $this->validatePrice();
        $this->validatedHeight();
        $this->validatedWidth();
        $this->validatedLength();
        return $this->errors;

    }

}

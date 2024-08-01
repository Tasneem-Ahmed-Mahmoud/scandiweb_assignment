<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::get();
        View::load("products/index", ["products" => $products]);
    }

    public function create()
    {

        View::load("products/create", ['types' => Product::$types]);
    }

    public function store()
    {

        if (empty($_POST['type']) || !in_array($_POST['type'], Product::$types)) {
            echo "please inter valid data";
            die;
        }
        $productType = "App\\Models\\ProductTypes\\" . $_POST['type'];

        if (class_exists($productType)) {

            $type = new $productType();
            foreach ($_POST as $key => $value) {
                $setMethod = "set" . ucfirst($key);
                if (method_exists($type, $setMethod)) {
                    $type->$setMethod(trim(htmlspecialchars($value)));
                }
            }
            if (count($type->uniqueSku($type->getSku()))) {
                echo "please inter unique sku";
                die;
            }

            if ($type->validateAttribute()) {
                echo "please inter valid data";
                die;
            } else {
                $type->getAttribute();
                $type->save();
                echo "success";
                die;
            }
        }
    }

    public function destroy()
    {
        Product::delete($_POST['ids']);
        echo "deleted successfully";
    }
}

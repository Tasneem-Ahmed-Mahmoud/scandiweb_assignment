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

            View::load("products/create", ['errors' => "please enter valid data", 'types' => Product::$types]);
        }
        $productType = "App\\Models\\ProductTypes\\" . $_POST['type'];
        if (class_exists($productType)) {
            $type = new $productType($_POST);

            if ($type->errors) {
                View::load("products/create", ['errors' => "please enter valid data", 'types' => Product::$types]);
            } else {
                $type->save();
                header("Location: /");
            }

        }

    }

    public function destroy()
    {
        Product::delete($_POST['ids']);
        echo "deleted successfully";
    }

}

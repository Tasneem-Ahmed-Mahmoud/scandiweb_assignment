<?php

use App\Controllers\ProductController;

$route = match ($_SERVER['REQUEST_METHOD']) {
    "POST" => match ($_SERVER['REQUEST_URI']) {
        "/products" => (new ProductController())->store(),
        "/products/delete" => (new ProductController())->destroy(),
        default => die("route not found"),
    },
    "GET" => match ($_SERVER['REQUEST_URI']) {
        "/addProduct" => (new ProductController())->create(),
        "/" => (new ProductController())->index(),
        default => die("route not found"),
    },
    default => die("this request method not found"),
};

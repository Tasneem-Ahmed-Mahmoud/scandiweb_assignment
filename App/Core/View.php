<?php
namespace App\Core;

class View
{

    public static function load($view, $data = [])
    {

        extract($data);
        $file = __DIR__ . "/../views/$view.php";
        if (file_exists($file)) {

            require $file;
            die;

        } else {
            throw new \Exception('View not found: ' . $view);
        }

    }


    
}

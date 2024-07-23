<?php
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    
    $file = __DIR__ . '/' . $class . '.php';
    if (file_exists($file)) {
       
        require $file;
       
    }else{
        throw new \Exception('Class not found: ' . $class);
    }

});




// spl_autoload_register(function ($class) {
//     $prefix = 'App\\Core\\';
//     $baseDir = __DIR__ . '/App/Core/';

//     $len = strlen($prefix);
//     if (strncmp($prefix, $class, $len) !== 0) {
//         return;
//     }

//     $relativeClass = substr($class, $len);
//     $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

//     if (file_exists($file)) {
//         require $file;
//     }
// });
?>

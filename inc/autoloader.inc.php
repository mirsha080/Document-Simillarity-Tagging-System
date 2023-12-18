<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {

    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    
    // $fullPath = $path . $className . $extension  || strpos($url, 'pages') !== false;

    if (strpos($url, 'includes') !== false){
        $path = '../mvc/';
    }
    else {
        $path = 'mvc/';
    }

   $extension = ".class.php";
   include_once $path . $className . $extension;
}
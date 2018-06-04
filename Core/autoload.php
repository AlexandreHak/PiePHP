<?php
spl_autoload_register(
    function ($class) {
        // autoloading testing, delete later
        // static $i = 1;
        // echo '<pre>';
        // var_dump("autoloading[{$i}] => " . $class);
        // echo '</pre>';
        // $i++;

        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        if (file_exists('src' . DIRECTORY_SEPARATOR . $class . '.php')) {
            require_once 'src' . DIRECTORY_SEPARATOR . $class . '.php';
        } /*elseif (file_exists('src' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $class . '.php')) {
            require_once 'src' . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . $class . '.php';
        }*/ else {
            require_once $class . '.php';
        }
    }
);
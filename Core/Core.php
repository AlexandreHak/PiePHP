<?php
namespace Core;

class Core
{
    public static function run()
    {
        $uri = Request::uri();
        $route = Router::get($uri);
        $route['controller'] = 'Controller' . DIRECTORY_SEPARATOR . $route['controller'];
        
        $obj = new $route['controller'];
        $obj->{ $route['action'] }();
    }

    // public function __destruct()
    // {
    //     if (!empty($_SESSION)) {
    //         foreach ($_SESSION as $key => $value) {
    //             if ($key !== 'auth') {
    //                 echo $key . "\n";
    //                 unset($_SESSION[$key]);
    //             }
    //         }
    //     }
    // }
}
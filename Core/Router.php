<?php
namespace Core;

class Router {
    private static $routes;
    
    public static function connect($url, $route) {
        self::$routes[$url] = $route;
    }

    public static function get($url) {
        require 'routes.php';
        if (array_key_exists($url, self::$routes)) {
            return self::$routes[$url];
        } else {
            exit('404');
        }
        // retourne un tableau asssociatif contenant
        // + le controller a instancier
        // + la méthode du controller a appeler
        // + un tableau contenant les paramètres à passer à la méthode du controller
    }
}
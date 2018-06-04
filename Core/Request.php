<?php
namespace Core;

class Request
{
    public function __construct()
    {
        foreach ($_REQUEST as $key => $value) {
            $this->{ $key } = $this->sanitize($value);
        }
    }

    public static function sanitize($value)
    {
        return htmlspecialchars(stripslashes(trim($value)));
    }

    public static function uri()
    {
        return rtrim(str_replace('piephp/', '', strtolower(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))), '/');
    }

    public static function clearSession()
    {
        if (!empty($_SESSION)) {
            foreach ($_SESSION as $key => $value) {
                if ($key !== 'auth') {
                    echo $key . "\n";
                    unset($_SESSION[$key]);
                }
            }
        }
    }
}
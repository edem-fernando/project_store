<?php

namespace Source\Core;


/**
 * Class Route: classe que monitora url
 * @package Source\Core
 */
class Route 
{
    protected static $route;
    
    /**
     * @param string $route
     * @param $handler
     * @return void
     */
    public static function get(string $route, $handler): void
    {
        $get = "/" . filter_input(INPUT_GET, $route, FILTER_SANITIZE_SPECIAL_CHARS);
        self::$route = [
            $route => [
                "route" => $route,
                "controller" => (!is_string($handler) ? $handler : strstr($handler, ":", true)), // example UserController:home
                "method" => (!is_string($handler)) ? $handler : str_replace(":", "", strstr($handler, ":", false))
            ]
        ];
        self::dispach($get);
    }
    
    /**
     * @param $route
     * @return void
     */
    public static function dispach($route): void
    {
        $route = (self::$route[$route] ?? []);
        if ($route) {
            if ($route["controller"] instanceof \Closure) {
                call_user_func($route["controller"]);
                return;
            }

            $controller = self::namespace() . $route["controller"];
            $method = $route["method"];
            if (class_exists($controller)) {
                $new_controller = new $controller;
                if (method_exists($controller, $method)) {
                    $new_controller->$method();
                }
            }
        }
    }
    
    /**
     * @return array
     */
    public static function route(): array
    {
        return self::$route;
    }
    
    /**
     * @return string
     */
    private static function namespace(): string
    {
        return "Source\App\Controllers\\";
    }
}

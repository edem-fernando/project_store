<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * Bootstrap
 */
use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

/**
 * Web Routes
 */
$route->namespace("Source\App");
$route->get("/", "Web:home");

/**
 * Route
 */
$route->dispatch();

/**
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();

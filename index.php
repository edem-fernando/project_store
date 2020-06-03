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
$route->get("/blog", "Web:blog");
$route->get("/blog/page/{page}", "Web:blog");
$route->get("/blog/{postName}", "Web:blogPost");

$route->get("/escola", "Web:school");
$route->get("/entrar", "Web:login");

$route->get("/receber-noticias", "Web:optinRegister");
$route->get("/lista-vip", "Web:optinVip");

$route->get("/contatos", "Web:contacts");
$route->get("/politicas", "Web:politcs");
$route->get("/aviso", "Web:warning");
$route->get("/termos", "Web:terms");


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

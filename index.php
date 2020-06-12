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

// blog
$route->get("/blog", "Web:blog");
$route->get("/blog/page/{page}", "Web:blog");
$route->get("/blog/{postName}", "Web:blogPost");

// scholl
$route->get("/escola", "Web:school");
$route->get("/entrar", "Web:login");

// optin
$route->post("/receber-noticias", "Web:optinRegister");
$route->get("/lista-vip", "Web:optinVip");
$route->post("/lista-vip/link", "Web:optinVipSuccess");

// terms, politcs and warnings
$route->get("/politicas", "Web:politcs");
$route->get("/aviso", "Web:warning");
$route->get("/termos", "Web:terms");

/**
 * Error Routes
 */
$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

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

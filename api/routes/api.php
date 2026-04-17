<?php

use Api\Controllers\ProductController;
use Api\Controllers\AuthController;
use Api\Middleware\AuthMiddleware;

/** @var $router */

$router->add('GET', '/api/products', [
    // 'controller' => ProductController::class,
    // 'method' => 'index'
]);

$router->add('POST', '/api/login', [
    // 'controller' => AuthController::class,
    // 'method' => 'login'
]);

$router->add('GET', '/api/cart', [
    // 'controller' => ProductController::class,
    // 'method' => 'cart',
    // 'middleware' => [AuthMiddleware::class]
]);
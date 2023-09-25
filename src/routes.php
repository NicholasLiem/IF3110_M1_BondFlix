<?php
global $routes;
global $container;

use Router\Router;
use Handlers\LoginHandler;
use Handlers\RegisterHandler;

/**
 * Registering the singleton handlers
 */
$loginHandler = LoginHandler::getInstance($container);
$registerHandler = RegisterHandler::getInstance($container);

/**
 * Making new router instance
 */
$router = new Router();


/**
 * Registering the routes
 */
$router->get('/',function () {
    require_once BASE_PATH . '/public/view/dashboard.php';
});

$router->get('/login', function () use ($loginHandler) {
    $loginHandler->get();
});

$router->post('/login', function () use ($loginHandler) {
    $loginHandler->post();
});

$router->get('/register', function () use ($registerHandler) {
    $registerHandler->get();
});

$router->post('/register', function () use ($registerHandler) {
    $registerHandler->post();
});

$router->get('/dashboard', function () {
    require_once BASE_PATH . '/public/view/dashboard.php';
});


$router->get('/register', function() {
    require_once BASE_PATH . '/public/view/register.php';
});

$router->addNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->run();
<?php
global $routes;
global $container;

use Handler\Auth\LoginHandler;
use Router\Router;

/**
 * Registering the singleton handlers
 */
$loginHandler = LoginHandler::getInstance($container);

/**
 * Making new router instance
 */
$router = new Router();


/**
 * Registering the routes
 */
$router->addPage('/', function ($urlParams) {
    require_once BASE_PATH . '/public/view/dashboard.php';
});

$router->addPage('/login', function () {
    redirect('login');
}, []);

$router->addAPI('/api/login', 'GET', $loginHandler, []);
$router->addAPI('/api/login', 'POST', $loginHandler, []);;


$router->setPageNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->setApiNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->run();
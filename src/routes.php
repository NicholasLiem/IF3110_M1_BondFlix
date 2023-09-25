<?php
global $routes;
global $container;

use Router\Router;
use Handlers\LoginHandler;
use Handlers\RegisterHandler;


$loginHandler = LoginHandler::getInstance($container);
$registerHandler = RegisterHandler::getInstance($container);

$router = new Router();



$router->get('/login', function () use ($loginHandler) {
    $loginHandler->showPage();
});

$router->post('/login', function () use ($loginHandler) {
    $loginHandler->login();
});

$router->get('/register', function () use ($registerHandler) {
    $registerHandler->showPage();
});

$router->post('/register', function () use ($registerHandler) {
    $registerHandler->register();
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
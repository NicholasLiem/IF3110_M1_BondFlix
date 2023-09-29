<?php
global $routes;
global $container;

use Handler\Auth\LoginHandler;
use Handler\Auth\RegisterHandler;
use Handler\Auth\LogoutHandler;
use Handler\Upload\UploadHandler;
use Router\Router;

/**
 * Registering the singleton handlers
 */
$loginHandler = LoginHandler::getInstance($container);
$registerHandler = RegisterHandler::getInstance($container);
$logoutHandler = LogoutHandler::getInstance($container);
$uploadHandler = UploadHandler::getInstance($container);

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

$router->get('/upload', function () use ($uploadHandler){
    $uploadHandler->get();
});

$router->post('/upload', function () use ($uploadHandler){
    $uploadHandler->post();
});


$router->get('/logout', function () use ($logoutHandler){
   $logoutHandler->get();
});

$router->get('/dashboard', function () {
    require_once BASE_PATH . '/public/view/dashboard.php';
});


$router->get('/profile', function () {
    redirect('profile');
});

$router->addNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->run();
<?php
global $routes;
global $container;

use Handler\Auth\LoginHandler;
use Handler\Auth\LogoutHandler;
use Handler\Auth\RegisterHandler;
use Middleware\Page\AdminCheck;
use Middleware\Page\LoggedInCheck;
use Router\Router;

/**
 * Registering the singleton handlers
 */
$loginHandler = LoginHandler::getInstance($container);
$registerHandler = RegisterHandler::getInstance($container);
$logoutHandler = LogoutHandler::getInstance($container);

/**
 * Making new router instance
 */
$router = new Router();


/**
 * Registering the page routes
 */
$router->addPage('/', function () {
    redirect('index');
});

$router->addPage('/login', function () {
    redirect('login');
}, []);

$router->addPage('/dashboard', function () {
    redirect('dashboard');
}, [LoggedInCheck::getInstance()]);

$router->addPage('/register', function () {
    redirect('register');
});

$router->addPage('/admin', function () {
    redirect('admin');
}, [LoggedInCheck::getInstance()]);

$router->addPage('/admin/movies', function () {
    redirect('admin-movies');
}, [AdminCheck::getInstance(), LoggedInCheck::getInstance()]);

$router->addPage('/admin/movies/upload', function() {
    redirect('adminMovieUpload');
}, [AdminCheck::getInstance(), LoggedInCheck::getInstance()]);

/**
 * Registering the api routes
 */

$router->addAPI('/api/auth/login', 'POST', $loginHandler, []);;
$router->addAPI('/api/auth/register', 'POST', $registerHandler, []);;
$router->addAPI('/api/auth/logout', 'POST', $logoutHandler, [LoggedInCheck::getInstance()]);;

/**
 * Setting api or page fallback handler
 */

$router->setPageNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->setApiNotFoundHandler(function () {
    require_once BASE_PATH . '/public/view/404.php';
});

$router->run();
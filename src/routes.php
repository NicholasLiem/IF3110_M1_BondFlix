<?php
global $routes;
global $container;

use Handler\Auth\LoginHandler;
use Handler\Auth\LogoutHandler;
use Handler\Auth\RegisterHandler;
use Handler\User\UserHandler;
use Middleware\Page\AdminCheck;
use Middleware\Page\LoggedInCheck;
use Router\Router;
use Handler\Content\ContentHandler;
use Handler\Content\ContentActorHandler;
use Handler\Content\ContentCategoryHandler;

/**
 * Registering the singleton handlers
 */
$loginHandler = LoginHandler::getInstance($container);
$registerHandler = RegisterHandler::getInstance($container);
$logoutHandler = LogoutHandler::getInstance($container);
$userHandler = UserHandler::getInstance($container);
$contentHandler = ContentHandler::getInstance($container);
$contentActorHandler = ContentActorHandler::getInstance($container);
$contentCategoryHandler = ContentCategoryHandler::getInstance($container);

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

$router->addPage('/register', function ($urlParams) {
    redirect('register', ['urlParams' => $urlParams]);
});

$router->addPage('/admin', function () {
    redirect('admin');
}, [LoggedInCheck::getInstance(), AdminCheck::getInstance()]);

$router->addPage('/admin/movies', function () {
    redirect('admin-movies');
}, [LoggedInCheck::getInstance(), AdminCheck::getInstance()]);

$router->addPage('/admin/users', function () {
    redirect('admin-users');
}, [LoggedInCheck::getInstance(), AdminCheck::getInstance()]);

$router->addPage('/admin/movies/upload', function() {
    redirect('admin-movie-upload');
}, [LoggedInCheck::getInstance(), AdminCheck::getInstance()]);

/**
 * Registering the api routes
 */

$router->addAPI('/api/auth/login', 'POST', $loginHandler, []);;
$router->addAPI('/api/auth/register', 'POST', $registerHandler, []);;
$router->addAPI('/api/auth/logout', 'POST', $logoutHandler, [LoggedInCheck::getInstance()]);;

$router->addAPI('/api/users', 'GET', $userHandler, [AdminCheck::getInstance()]);

//TODO: add middleware if needed
$router->addAPI('/api/content', 'GET', $contentHandler, []);
$router->addAPI('/api/content', 'POST', $contentHandler, []);
$router->addAPI('/api/content', 'PUT', $contentHandler, []);
$router->addAPI('/api/content', 'DELETE', $contentHandler, []);

$router->addAPI('/api/content/actor', 'GET', $contentActorHandler, []);
$router->addAPI('/api/content/actor', 'POST', $contentActorHandler, []);
$router->addAPI('/api/content/actor', 'DELETE', $contentActorHandler, []);

$router->addAPI('/api/contet/category', 'GET', $contentCategoryHandler, []);
$router->addAPI('/api/content/category', 'POST', $contentCategoryHandler, []);
$router->addAPI('/api/content/category', 'DELETE', $contentCategoryHandler, []);
 
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
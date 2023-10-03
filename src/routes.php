<?php
global $routes;
global $container;

use Handler\Auth\LoginHandler;
use Handler\Auth\LogoutHandler;
use Handler\Auth\RegisterHandler;
use Handler\Genre\GenreHandler;
use Handler\User\UserHandler;
use Middleware\Page\AdminCheck;
use Middleware\Page\LoggedInCheck;
use Router\Router;
use Handler\Content\ContentHandler;
use Handler\Content\ContentActorHandler;
use Handler\Content\ContentCategoryHandler;
use Handler\Content\ContentDirectorHandler;
use Handler\Content\ContentGenreHandler;

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
$contentDirectorHandler = ContentDirectorHandler::getInstance($container);
$contentGenreHandler = ContentGenreHandler::getInstance($container);
$genreHandler = GenreHandler::getInstance($container);

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

$router->addPage('/admin/media/management', function () {
    redirect('admin-media-management');
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
$router->addAPI('/api/users', 'DELETE', $userHandler, [AdminCheck::getInstance()]);
$router->addAPI('/api/users', 'PUT', $userHandler, [AdminCheck::getInstance()]);

//TODO: add middleware if needed
$router->addAPI('/api/content', 'GET', $contentHandler, []);
$router->addAPI('/api/content', 'POST', $contentHandler, []);
$router->addAPI('/api/content', 'PUT', $contentHandler, []);
$router->addAPI('/api/content', 'DELETE', $contentHandler, []);

$router->addAPI('/api/content/actor', 'GET', $contentActorHandler, []);
$router->addAPI('/api/content/actor', 'POST', $contentActorHandler, []);
$router->addAPI('/api/content/actor', 'DELETE', $contentActorHandler, []);

$router->addAPI('/api/content/category', 'GET', $contentCategoryHandler, []);
$router->addAPI('/api/content/category', 'POST', $contentCategoryHandler, []);
$router->addAPI('/api/content/category', 'DELETE', $contentCategoryHandler, []);

$router->addAPI('/api/content/director', 'GET', $contentDirectorHandler, []);
$router->addAPI('/api/content/director', 'POST', $contentDirectorHandler, []);
$router->addAPI('/api/content/director', 'DELETE', $contentDirectorHandler, []);

$router->addAPI('/api/content/genre', 'GET', $contentGenreHandler, []);
$router->addAPI('/api/content/genre', 'POST', $contentGenreHandler, []);
$router->addAPI('/api/content/genre', 'DELETE', $contentGenreHandler, []);

$router->addAPI('/api/genre', 'POST', $genreHandler, []);

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
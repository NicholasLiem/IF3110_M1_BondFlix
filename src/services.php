<?php

use Core\Application\Services\ContentService;
use Core\Infrastructure\Persistence\PersistentContentRepository;
use Core\Infrastructure\Persistence\PersistentUserRepository;
use Container\ServiceContainer;
use Core\Application\Services\AuthService;
use Core\Application\Services\AdminService;
use Database\Connection;

$container = new ServiceContainer();

$container->register('db', function () {
    return Connection::getDBInstance();
});

$container->register('userRepository', function($container){
    $db = $container->resolve('db');
    return new PersistentUserRepository($db);
});

$container->register('contentRepository', function($container){
    $db = $container->resolve('db');
    return new PersistentContentRepository($db);
});

$container->register('authService', function ($container){
    $userRepository = $container->resolve('userRepository');
    return new AuthService($userRepository);
});

$container->register('adminService', function ($container){
    $userRepository = $container->resolve('userRepository');
    return new AdminService($userRepository);
});

$container->register('contentService', function($container){
    $contentRepository = $container->resolve('contentRepository');
    return new ContentService($contentRepository);
});
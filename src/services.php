<?php

use Core\Infrastructure\Persistence\PersistentUserRepository;
use Container\ServiceContainer;
use Core\Application\Services\AuthService;
use Database\Connection;

$container = new ServiceContainer();

$container->register('db', function () {
    return Connection::getDBInstance();
});

$container->register('userRepository', function($container){
    $db = $container->resolve('db');
    return new PersistentUserRepository($db);
});

$container->register('authService', function ($container){
    $userRepository = $container->resolve('userRepository');
    return new AuthService($userRepository);
});
<?php

use Core\Infrastructure\Persistence\PersistentUserRepository;
use Container\ServiceContainer;
use Core\Application\Services\UserService;
use Database\Connection;

$container = new ServiceContainer();

$container->register('db', function () {
    return Connection::getDBInstance();
});

$container->register('userRepository', function($container){
    $db = $container->resolve('db');
    return new PersistentUserRepository($db);
});

$container->register('userService', function ($container){
    $userRepository = $container->resolve('userRepository');
    return new UserService($userRepository);
});
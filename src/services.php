<?php
require "Containers/ServiceContainer.php";
require 'Database/Connection.php';
require "Core/Infrastructure/Persistence/PersistentUserRepository.php";
require "Core/Application/Services/UserService.php";

use Core\Infrastructure\Persistence\PersistentUserRepository;
use Containers\ServiceContainer;
use Core\Application\Services\UserService;
use Database\Connection;

$container = new ServiceContainer();

$container->register('db', function () {
    static $dbInstance;
    if ($dbInstance === null) {
        $dbInstance = Connection::getDBInstance();
    }
    return $dbInstance;
});

$container->register('userRepository', function($container){
    $db = $container->resolve('db');
    return new PersistentUserRepository($db);
});

$container->register('userService', function ($container){
    $userRepository = $container->resolve('userRepository');
    return new UserService($userRepository);
});
<?php

use Container\DatabaseContainer;
use Container\RepositoryContainer;
use Container\ServiceContainer;
use Core\Application\Services\AdminService;
use Core\Application\Services\AuthService;
use Core\Application\Services\ContentService;
use Core\Application\Services\GenreService;
use Core\Infrastructure\Persistence\PersistentContentRepository;
use Core\Infrastructure\Persistence\PersistentGenreRepository;
use Core\Infrastructure\Persistence\PersistentUserRepository;
use Database\Connection;

/**
 * @throws Exception
 */
try {
    $databaseContainer = new DatabaseContainer(Connection::getDBInstance());
    $db = $databaseContainer->getDb();
    $repositoryContainer = new RepositoryContainer(
        userRepository: new PersistentUserRepository($db),
        contentRepository: new PersistentContentRepository($db),
        genreRepository: new PersistentGenreRepository($db)
    );

    $userRepository = $repositoryContainer->getUserRepository();
    $contentRepository = $repositoryContainer->getContentRepository();
    $genreRepository = $repositoryContainer->getGenreRepository();

    $serviceContainer = new ServiceContainer(
        authService: new AuthService($userRepository),
        adminService: new AdminService($userRepository),
        contentService: new ContentService($contentRepository),
        genreService: new GenreService($genreRepository),
    );
} catch (Exception $e) {
}

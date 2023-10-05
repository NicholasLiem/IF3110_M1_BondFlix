<?php

namespace Container;

use Core\Application\Repositories\ContentRepository;
use Core\Application\Repositories\GenreRepository;
use Core\Application\Repositories\UserRepository;
use Exception;
use Utils\Logger\Logger;

class RepositoryContainer
{
    private UserRepository $userRepository;
    private ContentRepository $contentRepository;
    private GenreRepository $genreRepository;

    /**
     * @param UserRepository $userRepository
     * @param ContentRepository $contentRepository
     * @param GenreRepository $genreRepository
     */
    public function __construct(UserRepository $userRepository, ContentRepository $contentRepository, GenreRepository $genreRepository)
    {
        $this->userRepository = $userRepository;
        $this->contentRepository = $contentRepository;
        $this->genreRepository = $genreRepository;
    }

    /**
     * Get the UserRepository
     *
     * @throws Exception
     */
    public function getUserRepository(): UserRepository
    {
        if (!isset($this->userRepository)) {
            Logger::getInstance()->logMessage("Failed to load UserRepository repository");
            throw new Exception("Repository 'UserRepository' not found in the container.");
        }
        return $this->userRepository;
    }

    public function setUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get the ContentRepository
     *
     * @throws Exception
     */
    public function getContentRepository(): ContentRepository
    {
        if (!isset($this->contentRepository)) {
            Logger::getInstance()->logMessage("Failed to load ContentRepository repository");
            throw new Exception("Repository 'ContentRepository' not found in the container.");
        }
        return $this->contentRepository;
    }

    public function setContentRepository(ContentRepository $contentRepository): void
    {
        $this->contentRepository = $contentRepository;
    }

    /**
     * Get the GenreRepository
     *
     * @throws Exception
     */
    public function getGenreRepository(): GenreRepository
    {
        if (!isset($this->genreRepository)) {
            Logger::getInstance()->logMessage("Failed to load GenreRepository repository");
            throw new Exception("Repository 'GenreRepository' not found in the container.");
        }
        return $this->genreRepository;
    }

    public function setGenreRepository(GenreRepository $genreRepository): void
    {
        $this->genreRepository = $genreRepository;
    }
}

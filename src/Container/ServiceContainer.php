<?php

namespace Container;
use Core\Application\Services\AdminService;
use Core\Application\Services\AuthService;
use Core\Application\Services\ContentService;
use Core\Application\Services\GenreService;
use Exception;
use Utils\Logger\Logger;

class ServiceContainer
{
    private AuthService $authService;
    private AdminService $adminService;
    private ContentService $contentService;
    private GenreService $genreService;

    /**
     * @param AuthService $authService
     * @param AdminService $adminService
     * @param ContentService $contentService
     * @param GenreService $genreService
     */
    public function __construct(AuthService $authService, AdminService $adminService, ContentService $contentService, GenreService $genreService)
    {
        $this->authService = $authService;
        $this->adminService = $adminService;
        $this->contentService = $contentService;
        $this->genreService = $genreService;
    }

    /**
     * @throws Exception
     */
    public function getAuthService(): AuthService
    {
        if (!isset($this->authService)){
            Logger::getInstance()->logMessage("Failed to load AuthService service");
            throw new Exception("Service 'AuthService' not found in the container.");
        }
        return $this->authService;
    }

    public function setAuthService(AuthService $authService): void
    {
        $this->authService = $authService;
    }

    /**
     * @throws Exception
     */
    public function getAdminService(): AdminService
    {
        if (!isset($this->adminService)){
            Logger::getInstance()->logMessage("Failed to load AdminService service");
            throw new Exception("Service 'AdminService' not found in the container.");
        }
        return $this->adminService;
    }

    public function setAdminService(AdminService $adminService): void
    {
        $this->adminService = $adminService;
    }

    /**
     * @throws Exception
     */
    public function getContentService(): ContentService
    {
        if (!isset($this->contentService)){
            Logger::getInstance()->logMessage("Failed to load ContentService service");
            throw new Exception("Service 'ContentService' not found in the container.");
        }
        return $this->contentService;
    }

    public function setContentService(ContentService $contentService): void
    {
        $this->contentService = $contentService;
    }

    /**
     * @throws Exception
     */
    public function getGenreService(): GenreService
    {
        if (!isset($this->genreService)){
            Logger::getInstance()->logMessage("Failed to load GenreService service");
            throw new Exception("Service 'GenreService' not found in the container.");
        }
        return $this->genreService;
    }

    public function setGenreService(GenreService $genreService): void
    {
        $this->genreService = $genreService;
    }
}

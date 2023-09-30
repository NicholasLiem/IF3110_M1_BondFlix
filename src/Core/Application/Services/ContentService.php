<?php

namespace Core\Application\Services;

use Core\Application\Repositories\ContentRepository;
use Core\Domain\Entities\Content;
use Exception;

class ContentService
{
    private ContentRepository $contentRepository;

    public function __construct($contentRepository) {
        $this->contentRepository = $contentRepository;
    }

    public function addContent(
        $title,
        $description,
        $release_date,
        $content_file_path
    ): ?Content {
        $content = new Content();
        $content->setTitle($title);
        $content->setDescription($description);
        $content->setReleaseDate($release_date);
        $content->setContentFilePath($content_file_path);

        return $this->contentRepository->createContent($content);
    }

    public function removeContent($content_id) {
        return $this->contentRepository->deleteContentById($content_id);
    }

    public function updateContent(
        int $content_id, 
        null|string $title, 
        null|string $description, 
        null|string $release_date, 
        null|string $content_file_path
    ) : ?Content {
        $updatedContent = $this->contentRepository->getContentById($content_id);

        if (is_null($updatedContent)) {
            throw new Exception("Content id not found");
        }

        if (!is_null($title)) $updatedContent->setTitle($title);
        if (!is_null($description)) $updatedContent->setDescription($description);
        if (!is_null($release_date)) $updatedContent->setReleaseDate($release_date);
        if (!is_null($content_file_path)) $updatedContent->setContentFilePath($content_file_path);

        return $this->contentRepository->updateContent($updatedContent);
    }
}
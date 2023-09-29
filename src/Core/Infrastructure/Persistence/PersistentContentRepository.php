<?php

namespace Core\Infrastructure\Persistence;

use Core\Application\Repositories\ContentRepository;
use Core\Domain\Entities\Content;

class PersistentContentRepository implements ContentRepository
{

    public function getContentById(int $content_id): ?Content
    {
        // TODO: Implement getContentById() method.
        return null;
    }

    public function createContent(Content $content): ?Content
    {
        // TODO: Implement createContent() method.
        return null;
    }

    public function updateContent(Content $content): ?Content
    {
        // TODO: Implement updateContent() method.
        return null;
    }

    public function deleteContentById(int $content_id)
    {
        // TODO: Implement deleteContentById() method.
        return null;
    }
}
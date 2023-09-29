<?php
namespace Core\Application\Repositories;
use Core\Domain\Entities\Content;

interface ContentRepository {
    public function getContentById(int $content_id) : ?Content;
    public function createContent(Content $content) : ?Content;
    public function updateContent(Content $content) : ?Content;
    public function deleteContentById(int $content_id);

}
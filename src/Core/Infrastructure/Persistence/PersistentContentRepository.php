<?php

namespace Core\Infrastructure\Persistence;

use Core\Application\Repositories\ContentRepository;
use Core\Domain\Entities\Content;
use Exception;
use PDO;

class PersistentContentRepository implements ContentRepository
{
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getContentById(int $content_id): ?Content
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM content
            WHERE content_id = :content_id
        ");

        $stmt->bindParam(':content_id', $content_id);

        if (!$stmt->execute()) {
            throw new Exception("Database error while fetching content data");
        }

        $contentData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$contentData) {
            return null;
        }

        return new Content(
            (int) $contentData['content_id'],
            $contentData['title'],
            $contentData['description'],
            $contentData['release_date'],
            $contentData['content_file_path']
        );
    }

    public function createContent(Content $content): ?Content
    {
        $stmt = $this->db->prepare("
        INSERT INTO content (
            title, 
            description, 
            release_date,
            content_file_path
        ) 
        VALUES (:title, :description, :release_date, :content_file_path)");

        $title = $content->getTitle();
        $description = $content->getDescription();
        $release_date = $content->getReleaseDate();
        $content_file_path = $content->getContentFilePath();

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':release_date', $release_date);
        $stmt->bindParam(':content_file_path', $content_file_path);

        if (!$stmt->execute()) {
            throw new Exception("Content creation failed");
        }

        $content->setContentId($this->getLastContentId());
        return $content;
    }

    public function updateContent(Content $content): ?Content
    {
        $stmt = $this->db->prepare("
        UPDATE content SET 
        title = :new_title,
        description = :new_description,
        release_date = :new_release_date,
        content_file_path = :new_content_file_path
        WHERE content_id = :content_id");

        $newTitle = $content->getTitle();
        $newDescription = $content->getDescription();
        $newReleaseDate = $content->getReleaseDate();
        $newContentFilePath = $content->getContentFilePath();

        $stmt->bindParam(':new_title', $newTitle);
        $stmt->bindParam(':new_description', $newDescription);
        $stmt->bindParam(':new_release_date', $newReleaseDate);
        $stmt->bindParam(':new_content_file_path', $newContentFilePath);

        if (!$stmt->execute()) {
            throw new Exception("User update failed");
        }

        return $content;
    }

    public function deleteContentById(int $content_id)
    {
        $stmt = $this->db->prepare("
        DELETE FROM content
        WHERE content_id = :content_id;
        ");

        $stmt->bindParam(':content_id', $content_id);

        if (!$stmt->execute()) {
            throw new Exception("Content deletion failed");
        }
    }

    private function getLastContentId(): int
    {
        $stmt = $this->db->prepare("
            SELECT MAX(content_id) as max_content_id
            FROM content
        ");

        if (!$stmt->execute()) {
            throw new Exception("Failed to find last content id");
        }

        $maxContentData = $stmt->fetch();
        if (is_null($maxContentData['max_content_id'])) {
            return 0;
        }

        return $maxContentData;
    }

    // TODO: function untuk cari actors yg bermain di movie
    // TODO: function untuk cari directors movie
    // TODO: function untuk cari genre movie
    // TODO: function untuk hitung rata-rata rating
}
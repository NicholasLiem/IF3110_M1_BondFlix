<?php

namespace Core\Domain\Entities;

class Content {
    private int $content_id;
    private string $title;
    private string $description;
    private string $release_data;
    private string $content_file_path;

    /**
     * @param int|null $content_id
     * @param string $title
     * @param string $description
     * @param string $release_data
     * @param string $content_file_path
     */
    public function __construct(
        int $content_id = null,
        string $title = '',
        string $description = '',
        string $release_data = '',
        string $content_file_path = '')
    {
        $this->content_id = $content_id;
        $this->title = $title;
        $this->description = $description;
        $this->release_data = $release_data;
        $this->content_file_path = $content_file_path;
    }


    public function getContentId(): int
    {
        return $this->content_id;
    }

    public function setContentId(int $content_id): void
    {
        $this->content_id = $content_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReleaseData(): string
    {
        return $this->release_data;
    }

    public function setReleaseData(string $release_data): void
    {
        $this->release_data = $release_data;
    }

    public function getContentFilePath(): string
    {
        return $this->content_file_path;
    }

    public function setContentFilePath(string $content_file_path): void
    {
        $this->content_file_path = $content_file_path;
    }
}

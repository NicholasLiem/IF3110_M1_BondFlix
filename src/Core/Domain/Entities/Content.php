<?php
namespace Core\Domain\Entities;

class Content
{
    private $content_id;
    private $title;
    private $description;
    private $release_date;
    private $actors;
    private $file_loc;

    public function __construct(
        int $content_id = null,
        string $title = null,
        string $description = null,
        string $release_date = null,
        string $file_loc
    ) {
      $this->content_id = $content_id;
      $this->title = $title;
      $this->description = $description;
      $this->release_date = $release_date;
      $this->file_loc = $file_loc;
    }

    public function getContentId(): int {
      return $this->content_id;
    }

    public function getTitle(): string {
      return $this->title;
    }

    public function getDescription(): string {
      return $this->description;
    }

    public function getReleaseDate(): string {
      return $this->release_date;
    }

    public function getFileLoc(): string {
      return $this->file_loc;
    }

    public function setContentId($content_id) {
      $this->content_id = $content_id;
    }

    public function setTitle($title) {
      $this->title = $title;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function setReleaseDate($release_date) {
      $this->release_date = $release_date;
    }
    
    public function setFileLoc($file_loc) {
      $this->file_loc = $file_loc;
    }
}

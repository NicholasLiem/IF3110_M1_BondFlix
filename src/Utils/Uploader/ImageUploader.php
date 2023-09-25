<?php

namespace Utils\Uploader;
use Exception;

class ImageUploader implements IUploader
{
    public array $types;
    public string $rootDir;
    const MAX_FILE_SIZE = 5000000;
    public function __construct()
    {
        $this->rootDir = '/uploads/';
    }

    /**
     * @throws Exception
     */
    public function upload($targetFile)
    {
        $targetDir = BASE_PATH . $this->rootDir;

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $target_file = $targetDir . $targetFile;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            throw new Exception('File already exists');
        }

        if ($_FILES['fileToUpload']['size'] > ImageUploader::MAX_FILE_SIZE) {
            throw new Exception('File is too big');
        }

        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
            throw new Exception('This file type is not supported');
        }

        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    }
}
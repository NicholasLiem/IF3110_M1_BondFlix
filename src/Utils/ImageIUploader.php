<?php

namespace Utils;
use Exception;

class ImageIUploader implements IUploader
{
    public array $types;
    public string $rootDir;
    const MAX_FILE_SIZE = 5000000;
    public function __construct()
    {
        $this->types = ['jpg', 'img', 'png', 'jpeg', 'gif'];
        $this->rootDir = '/storage';
    }

    /**
     * @throws Exception
     */
    public function upload($path, $type)
    {
        if (file_exists($path)) {
            throw new Exception('File already exists');
        }

        if ($_FILES['fileToUpload']['size'] > ImageIUploader::MAX_FILE_SIZE) {
            throw new Exception('File is too big');
        }

        if ($type != 'jpg' && $type != 'png' && $type != 'jpeg' && $type != 'gif') {
            throw new Exception('This file type is not supported');
        }

        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);
    }
}
<?php

namespace Handler\Upload;

use Handler\BaseHandler;
use Utils\ImageIUploader;

class UploadHandler extends BaseHandler
{
    protected static UploadHandler $instance;
    protected $service;

    private function __construct($service)
    {
        $this->service = $service;
    }

    public static function getInstance($container): UploadHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                null
            );
        }
        return self::$instance;
    }

    public function get($params = null)
    {
        redirect('upload');
    }

    /**
     * @throws \Exception
     */
    public function post($params = null)
    {
        $target_dir = BASE_PATH . "/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $imageUploader = new ImageIUploader();
        $imageUploader->upload($target_file, $imageFileType);

        redirect('dashboard');
    }
}
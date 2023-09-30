<?php
//
//namespace Handler\Upload;
//
//use Handler\BaseHandler;
//use Utils\Uploader\ImageUploader;
//
//class UploadHandler extends BaseHandler
//{
//    protected static UploadHandler $instance;
//    protected $service;
//
//    private function __construct($service)
//    {
//        $this->service = $service;
//    }
//
//    public static function getInstance($container): UploadHandler
//    {
//        if (!isset(self::$instance)) {
//            self::$instance = new static(
//                null
//            );
//        }
//        return self::$instance;
//    }
//
//    public function get($params = null)
//    {
//        redirect('upload');
//    }
//
//    /**
//     * @throws \Exception
//     */
//    public function post($params = null)
//    {
//        $target_file = basename($_FILES["fileToUpload"]["name"]);
//
//        $imageUploader = new ImageUploader();
//        $imageUploader->upload($target_file);
//
//        redirect('dashboard');
//    }
//}
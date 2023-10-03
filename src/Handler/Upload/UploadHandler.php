<?php

namespace Handler\Upload;

use Exception;
use Handler\BaseHandler;
use Utils\Uploader\ImageUploader;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class UploadHandler extends BaseHandler
{
   protected static $instance;
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
        $uploadDir = $_POST["uploadDir"]; // misal: content, profilepic, etc.
        $targetFile = basename($_FILES["fileToUpload"]["name"]);
        $fileType = $_FILES["fileToUpload"]["type"];

        $imageType = ['image/jpeg', 'image/png', 'image/gif'];
        $videoType = ['video/mpeg', 'video/mp4'];

        if (in_array($fileType , $imageType)) {
            $imageUploader = new ImageUploader();
            $imageUploader->upload($targetFile, $uploadDir);
        }

        else if (in_array($fileType, $videoType)) {
            // $videoUploader = new VideoUploader();
            // $imageUploader->upload($targetFile, $uploadDir);
        }

        else {
            $response = new Response(true, HttpStatusCode::BAD_REQUEST, "File type not allowed", null);
        }

        $response = new Response(true, HttpStatusCode::OK, "File uploaded successfully", null);
        $response->encode_to_JSON();

        redirect('dashboard');
   }
}
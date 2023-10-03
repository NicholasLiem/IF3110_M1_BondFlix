<?php
namespace Handler\Content;

use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

//TODO: exception handling

class ContentHandler extends BaseHandler {
    
    protected static $instance;
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): ContentHandler {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('contentService')
            );
        }
        return self::$instance;
    }

    /*
     * route formats: 
     * /api/content => get all content data
     * /api/content?page={p} => get content data at page p
     * /api/content?content_id={id} => get a content with a specific id
     */
    protected function get($params = null)
    {
        if (isset($params['content_id'])) {
            $content = $this->service->getContentById($params['content_id']);
            if (is_null($content)) {
                $response = new Response(true, HttpStatusCode::NOT_FOUND ,"Content(s) not found", null);
                $response->encode_to_JSON();
                return;
            }
            $response = new Response(true, HttpStatusCode::OK ,"Content(s) retrieved successfully", $content->toArray());
            $response->encode_to_JSON();
            return;
        }

        $pageNumber = $params['page'] ?? null;
        $contents = $this->service->getAllContents($pageNumber);

        $contentsArray = [];
        foreach ($contents as $content) {
            $contentsArray[] = $content->toArray();
        }

        $response = new Response(true, HttpStatusCode::OK ,"Content(s) retrieved successfully", $contentsArray);
        $response->encode_to_JSON();
    }

    protected function post($params = null)
    {
        try {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $release_date = $_POST['release_date'];
            $content_file_path = $_POST['content_file_path'];
            $thumbnail_file_path = $_POST['thumbnail_file_path'];

            $content = $this->service->createContent(
                $title,
                $description,
                $release_date,
                $content_file_path,
                $thumbnail_file_path
            );

            $response = new Response(true, HttpStatusCode::OK, "Content created successfully", $content->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {

            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content creation failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }

    protected function put($params = null)
    {
        try {
            $putData = file_get_contents('php://input');
            parse_str($putData, $_PUT);

            $content_id = $_PUT['content_id'] ?? null;
            $title = $_PUT['title'] ?? null;
            $description = $_PUT['description'] ?? null;
            $release_date = $_PUT['release_date'] ?? null;
            $content_file_path = $_PUT['content_file_path'] ?? null;
            $thumbnail_file_path = $_PUT['thumbnail_file_path'] ?? null;

            $content = $this->service->updateContent(
                $content_id,
                $title,
                $description,
                $release_date,
                $content_file_path,
                $thumbnail_file_path
            );

            $response = new Response(true, HttpStatusCode::OK, "Content updated successfully", $content->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content update failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }

    }

    /*
     * route formats: 
     * /api/content?content_id={id} => delete a content with a specific id
     */
    protected function delete($params = null)
    {
        try {
            $this->service->removeContent($params['content_id']);
            $response = new Response(true, HttpStatusCode::OK, "Content deleted successfully", null);
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content deletion failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }
}
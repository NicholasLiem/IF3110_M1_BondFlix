<?php
namespace Handler\Content;

use Core\Application\Services\ContentService;
use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class ContentGenreHandler extends BaseHandler {
    
    protected static ContentGenreHandler $instance;
    protected ContentService $service;

    private function __construct(ContentService $contentService)
    {
        $this->service = $contentService;
    }

    public static function getInstance($contentService): ContentGenreHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $contentService
            );
        }
        return self::$instance;
    }

    /*
     * route formats:
     * /api/content/genre?content_id={cid} 
     */
    protected function get($params = null)
    {
        $genres = $this->service->getGenres($params['content_id']);
        $genresArray = [];
        foreach ($genres as $genre) {
            $genresArray[] = $genre->toArray();
        }

        $response = new Response(true, HttpStatusCode::OK ,"Genre(s) retrieved successfully", $genresArray);
        $response->encode_to_JSON();
    }

    protected function post($params = null)
    {
        try {
            $content_id = $_POST['content_id'];
            $genre_id = $_POST['genre_id'];

            $this->service->addGenre($content_id, $genre_id);

            $response = new Response(true, HttpStatusCode::OK ,"Genre(s) added successfully", null);
            $response->encode_to_JSON();
            
        } catch (Exception $e) {
            $response = new Response(true, HttpStatusCode::BAD_REQUEST ,"Failed to add genre(s)", null);
            $response->encode_to_JSON();
        }
    }

     /*
     * route formats:
     * /api/content/genre?content_id={cid}&genre_id={did} => delete genre with id=did from content with id=cid
     */
    protected function delete($params = null)
    {
        try {
            $this->service->removeGenre($params['content_id'], $params['genre_id']);
            $response = new Response(true, HttpStatusCode::OK, "Genre deleted successfully", null);
            $response->encode_to_JSON();
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Genre deletion failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }
}
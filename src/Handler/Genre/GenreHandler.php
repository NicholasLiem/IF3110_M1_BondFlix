<?php

namespace Handler\Genre;

use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class GenreHandler extends BaseHandler
{
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): GenreHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('genreService')
            );
        }
        return self::$instance;
    }

    /* 
     * format: 
     * /api/genre
     * /api/genre?genre_id={gid} 
     */
    public function get($params = null) {
        if (isset($params['genre_id'])) {
            $genre = $this->service->getGenreById($params['genre_id']);
            if (is_null($genre)) {
                $response = new Response(false, HttpStatusCode::NOT_FOUND, "Genre id not found", null);
                $response->encode_to_JSON();
                return;
            }

            $genreArray = $genre->toArray();
            $response = new Response(true, HttpStatusCode::OK, "Genre found successfully", $genreArray);
            $response->encode_to_JSON();
            return;
        }

        $allGenres = $this->service->getAllGenre();
        $allGenresArray = [];

        foreach($allGenres as $genre) {
            $genreArray = $genre->toArray();
            $allGenresArray[] = $genreArray;
        }
        
        $response = new Response(true, HttpStatusCode::OK, "Genre found successfully", $allGenresArray);
        $response->encode_to_JSON();
    }
    public function post($params = null): void
    {
        $genre_name = $_POST['genre_name'];

        try {

            $genre = $this->service->addGenre($genre_name);
            $response = new Response(true, HttpStatusCode::OK ,"New genre successfully added", $genre->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {

            $response = new Response(false, HttpStatusCode::FORBIDDEN, "Invalid credentials", null);
            $response->encode_to_JSON();

        }
    }

    public function put($params = null) {
        try {
            if (!isset($params['genre_id'])) {
                $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Insufficient parameter: genre_id", null);
                $response->encode_to_JSON();
                return;
            }

            $genreId = $params['genre_id'];

            $genre = $this->service->getUserById($genreId);
            if (is_null($genre)) {
                $response = new Response(false, HttpStatusCode::NOT_FOUND, "User not found", null);
                $response->encode_to_JSON();
                return;
            }

            $genre->setGenreName($params['genre_name']);

            $result =$this->service->updateGenre($genre);

            if ($result) {
                $response = new Response(true, HttpStatusCode::OK, "Genre update success", $genre->toArray());
            } else {
                $response = new Response(false, HttpStatusCode::NO_CONTENT, "User update failed", null);
            } 

            $response->encode_to_JSON();
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Genre update failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }

    public function delete($params = null) {
        if (!isset($params['genre_id'])) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Insufficient parameter: genre_id", null);
            $response->encode_to_JSON();
            return;
        }

        $this->service->removeGenre($params['genre_id']);
    }
}
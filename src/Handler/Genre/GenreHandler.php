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
}
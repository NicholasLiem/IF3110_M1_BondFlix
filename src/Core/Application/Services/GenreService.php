<?php

namespace Core\Application\Services;

use Exception;
use Core\Domain\Entities\Genre;
use Core\Infrastructure\Persistence\PersistentGenreRepository;

class GenreService
{
    private PersistentGenreRepository $genreRepository;

    public function __construct($genreRepository) {
        $this->genreRepository = $genreRepository;
    }
    public function getAllGenre() : void {
        // TODO: implement
    }

    public function getGenreById(int $id) {
        // TODO: implement
    }
    public function removeGenre(int $_id): void {
        // TODO: implement
    }

    /**
     * @throws Exception
     */
    public function addGenre(string $genre_name): ?Genre {
        $newGenre = new Genre();
        $newGenre->setGenreName($genre_name);
        return $this->genreRepository->createGenre($newGenre);
    }
}
<?php

namespace Core\Infrastructure\Persistence;

use Core\Application\Repositories\GenreRepository;
use Core\Domain\Entities\Genre;

class PersistentGenreRepository implements GenreRepository
{

    public function createGenre(Genre $genre): ?Genre
    {
        // TODO: Implement createGenre() method.
        return null;

    }

    public function getGenreById(int $genre_id): ?Genre
    {
        // TODO: Implement getGenreById() method.
        return null;

    }

    public function updateGenre(Genre $genre): ?Genre
    {
        // TODO: Implement updateGenre() method.
        return null;

    }

    public function deleteGenreById(int $genre_id)
    {
        // TODO: Implement deleteGenreById() method.
        return null;
    }
}
<?php

namespace Core\Infrastructure\Persistence;

use Core\Application\Repositories\GenreRepository;
use Core\Domain\Entities\Genre;
use Exception;
use PDO;
use Utils\Logger\Logger;

class PersistentGenreRepository implements GenreRepository
{
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    public function createGenre(Genre $genre): ?Genre
    {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO genre (
                    genre_name)
                VALUES (:genre_name)");

            $genreName = $genre->getGenreName();
            $stmt->bindParam(':genre_name', $genreName);

            if (!$stmt->execute()) {
                Logger::getInstance()->logMessage('Genre creation failed');
                throw new Exception("Genre creation failed");
            }

            $genre->setGenreId($this->getGenreIdByName($genreName)->getGenreId());
            return $genre;
        } catch (Exception $e) {
            Logger::getInstance()->logMessage('User creation failed: ' . $e->getMessage());
            throw new Exception("User creation failed");
        }
    }

    public function getGenreById(int $genre_id): ?Genre
    {

        return null;

    }

    /**
     * @throws Exception
     */
    public function getGenreIdByName(string $genre_name) : ?Genre
    {
        try {
            $stmt = $this->db->prepare("SELECT genre_id FROM genre WHERE genre_name = :genre_name");
            $stmt->bindParam(':genre_name', $genre_name);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                Logger::getInstance()->logMessage('Genre fetch failed, no registered genre');
                throw new Exception("Genre fetch failed");
            }

            return new Genre($result['genre_id'], $genre_name);
        } catch (Exception $e) {
            Logger::getInstance()->logMessage('Error while fetching genre by name: ' . $e->getMessage());
            throw new Exception("Error while fetching genre by name");
        }
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
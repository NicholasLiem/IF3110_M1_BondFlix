<?php

namespace Core\Domain\Entities;

class Director
{
    private string $director_id;
    private string $first_name;
    private string $last_name;

    /**
     * @param string $director_id
     * @param string $first_name
     * @param string $last_name
     */
    public function __construct(string $director_id, string $first_name, string $last_name)
    {
        $this->director_id = $director_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getDirectorId(): string
    {
        return $this->director_id;
    }

    public function setDirectorId(string $director_id): void
    {
        $this->director_id = $director_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }


}
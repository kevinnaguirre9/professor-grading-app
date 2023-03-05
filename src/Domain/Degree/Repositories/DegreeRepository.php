<?php

namespace ProfessorGradingApp\Domain\Degree\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Degree\Degree;

/**
 * Interface DegreeRepository
 *
 * @package ProfessorGradingApp\Domain\Degree\Repositories
 */
interface DegreeRepository
{
    /**
     * @param Degree $Degree
     * @return void
     */
    public function save(Degree $Degree): void;

    /**
     * @param DegreeId $id
     * @return Degree|null
     */
    public function find(DegreeId $id): ?Degree;

    /**
     * @param string $name
     * @return Degree|null
     */
    public function findByName(string $name): ?Degree;
}

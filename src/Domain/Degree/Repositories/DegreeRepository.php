<?php

namespace ProfessorGradingApp\Domain\Degree\Repositories;

use ProfessorGradingApp\Domain\Degree\Degree;
use ProfessorGradingApp\Domain\Degree\ValueObjects\DegreeId;

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
}

<?php

namespace ProfessorGradingApp\Domain\Professor\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\Professor\ProfessorId;
use ProfessorGradingApp\Domain\Professor\Professor;

/**
 * Interface ProfessorRepository
 *
 * @package ProfessorGradingApp\Domain\Professor\Repositories
 */
interface ProfessorRepository
{
    /**
     * @param Professor $Professor
     * @return void
     */
    public function save(Professor $Professor): void;

    /**
     * @param ProfessorId $id
     * @return Professor|null
     */
    public function find(ProfessorId $id): ?Professor;

}

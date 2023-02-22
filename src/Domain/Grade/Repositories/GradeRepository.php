<?php

namespace ProfessorGradingApp\Domain\Grade\Repositories;

use ProfessorGradingApp\Domain\Grade\Grade;
use ProfessorGradingApp\Domain\Grade\ValueObjects\GradeId;

/**
 * Interface GradeRepository
 *
 * @package ProfessorGradingApp\Domain\Grade\Repositories
 */
interface GradeRepository
{
    /**
     * @param Grade $Grade
     * @return void
     */
    public function save(Grade $Grade): void;

    /**
     * @param GradeId $id
     * @return Grade|null
     */
    public function find(GradeId $id): ?Grade;
}

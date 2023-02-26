<?php

namespace ProfessorGradingApp\Domain\Grade\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\Grade\GradeId;
use ProfessorGradingApp\Domain\Grade\Grade;

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

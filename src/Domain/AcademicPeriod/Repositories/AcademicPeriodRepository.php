<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Repositories;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;

/**
 * Interface AcademicPeriodRepository
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Repositories
 */
interface AcademicPeriodRepository
{
    /**
     * @param AcademicPeriod $academicPeriod
     * @return void
     */
    public function save(AcademicPeriod $academicPeriod): void;

    /**
     * @param AcademicPeriodId $id
     * @return AcademicPeriod|null
     */
    public function find(academicPeriodId $id): ?AcademicPeriod;

    /**
     * @return AcademicPeriod
     */
    public function findCurrentAcademicPeriod(): AcademicPeriod;
}

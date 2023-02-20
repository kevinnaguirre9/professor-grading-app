<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Repositories;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Criteria\AcademicPeriodsCollection;
use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\Criteria\Criteria;

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
     * @return AcademicPeriod[]
     */
    public function all(): array;

    /**
     * @param AcademicPeriodId $id
     * @return AcademicPeriod|null
     */
    public function find(academicPeriodId $id): ?AcademicPeriod;

    /**
     * @param Criteria $criteria
     * @return AcademicPeriodsCollection
     */
    public function search(Criteria $criteria): AcademicPeriodsCollection;
}

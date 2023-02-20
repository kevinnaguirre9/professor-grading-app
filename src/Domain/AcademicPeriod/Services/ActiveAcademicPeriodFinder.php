<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Services;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Criteria\AcademicPeriodCriteria;
use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;

/**
 * Class ActiveAcademicPeriodFinder
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Services
 */
final class ActiveAcademicPeriodFinder
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(
        private readonly AcademicPeriodRepository $repository,
    ) {
    }

    /**
     * @return AcademicPeriod
     * @throws ActiveAcademicPeriodNotFound
     */
    public function __invoke() : AcademicPeriod
    {
        $criteria = (new AcademicPeriodCriteria)->withIsActiveFilter(true);

        $academicPeriods = $this->repository->search($criteria);

        if ($academicPeriods->isEmpty())
            throw new ActiveAcademicPeriodNotFound();

        return $academicPeriods->first();
    }
}

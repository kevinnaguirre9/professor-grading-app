<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Services;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Criteria\AcademicPeriodCriteria;
use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;

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
     * @throws EmptyReportFilters
     */
    public function __invoke() : AcademicPeriod
    {
        $criteria = (new AcademicPeriodCriteria)
            ->withIsActiveFilter(true)
            ->build();

        $academicPeriods = $this->repository->search($criteria);

        if ($academicPeriods->isEmpty())
            throw new ActiveAcademicPeriodNotFound();

        return $academicPeriods->first();
    }
}

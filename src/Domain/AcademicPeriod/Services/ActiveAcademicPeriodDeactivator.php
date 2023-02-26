<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Services;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Criteria\AcademicPeriodCriteria;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;

/**
 * Class ActiveAcademicPeriodDeactivator
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Services
 */
final class ActiveAcademicPeriodDeactivator
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(
        private readonly AcademicPeriodRepository $repository,
    ) {
    }

    /**
     * @return void
     * @throws EmptyReportFilters
     */
    public function __invoke(): void
    {
        $criteria = (new AcademicPeriodCriteria)
            ->withIsActiveFilter(true)
            ->build();

        $academicPeriods = $this->repository
            ->search($criteria)
            ->items();

        array_walk($academicPeriods, $this->academicPeriodDeactivator());
    }

    /**
     * @return \Closure
     */
    private function academicPeriodDeactivator(): \Closure
    {
        return function (AcademicPeriod $academicPeriod) {

            $academicPeriod->deactivate();

            $this->repository->save($academicPeriod);
        };
    }
}

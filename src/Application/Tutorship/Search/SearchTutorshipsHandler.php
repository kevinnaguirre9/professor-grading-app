<?php

namespace ProfessorGradingApp\Application\Tutorship\Search;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Tutorship\Criteria\TutorshipCriteria;
use ProfessorGradingApp\Domain\Tutorship\Repositories\TutorshipRepository;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;

/**
 * Class SearchTutorshipsHandler
 *
 * @package ProfessorGradingApp\Application\Tutorship\Search
 */
final class SearchTutorshipsHandler
{
    /**
     * @param TutorshipRepository $repository
     * @param ActiveAcademicPeriodFinder $academicPeriodFinder
     */
    public function __construct(
        private readonly TutorshipRepository $repository,
        private readonly ActiveAcademicPeriodFinder $academicPeriodFinder,
    ) {
    }

    /**
     * @param SearchTutorshipsCommand $command
     * @return iterable
     * @throws EmptyFilters
     * @throws ActiveAcademicPeriodNotFound
     * @throws EmptyReportFilters
     */
    public function __invoke(SearchTutorshipsCommand $command): iterable
    {
        $AcademicPeriod = $this->academicPeriodFinder->__invoke();

        $criteria = new TutorshipCriteria(
            $command->filters(),
            $command->limit(),
            $command->page(),
        );

        $criteria->withAcademicPeriodFilter($AcademicPeriod->id());

        return $this->repository->search($criteria->build());
    }
}

<?php

namespace ProfessorGradingApp\Application\Tutorship\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Domain\Tutorship\Repositories\TutorshipRepository;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;
use ProfessorGradingApp\Domain\Tutorship\ValueObjects\{AdvisorId, TutorshipId};

/**
 * Class RegisterTutorshipHandler
 *
 * @package ProfessorGradingApp\Application\Tutorship\Register
 */
final class RegisterTutorshipHandler
{
    /**
     * @param TutorshipRepository $repository
     * @param ActiveAcademicPeriodFinder $academicPeriodFinder
     */
    public function __construct(
        private readonly TutorshipRepository $repository,
        private readonly ActiveAcademicPeriodFinder $academicPeriodFinder,
    )
    {
    }

    /**
     * @param RegisterTutorshipCommand $command
     * @return void
     * @throws InvalidUuid
     * @throws ActiveAcademicPeriodNotFound
     * @throws EmptyReportFilters
     */
    public function __invoke(RegisterTutorshipCommand $command): void
    {
        //TODO: validate if the advisor is already assigned to a tutorship in the same subject

        if(! empty($command->dailySchedules()))
            $Schedule = Schedule::fromPrimitives($command->dailySchedules());

        $academicPeriod = $this->academicPeriodFinder->__invoke();

        $Tutorship = Tutorship::create(
            new TutorshipId(),
            new AdvisorId($command->advisorId()),
            new SubjectId($command->subjectId()),
            $academicPeriod->id(),
            $Schedule ?? null,
        );

        $this->repository->save($Tutorship);
    }
}

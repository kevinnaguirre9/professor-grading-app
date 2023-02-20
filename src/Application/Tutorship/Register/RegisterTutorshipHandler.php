<?php

namespace ProfessorGradingApp\Application\Tutorship\Register;

use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Tutorship\Repositories\TutorshipRepository;
use ProfessorGradingApp\Domain\Tutorship\Tutorship;
use ProfessorGradingApp\Domain\Tutorship\ValueObjects\{AcademicPeriodId, AdvisorId, SubjectId, TutorshipId};

/**
 * Class RegisterTutorshipHandler
 *
 * @package ProfessorGradingApp\Application\Tutorship\Register
 */
final class RegisterTutorshipHandler
{
    /**
     * @param TutorshipRepository $repository
     */
    public function __construct(private readonly TutorshipRepository $repository)
    {
    }

    /**
     * @param RegisterTutorshipCommand $command
     * @return void
     * @throws InvalidUuid
     */
    public function __invoke(RegisterTutorshipCommand $command): void
    {
        if(!empty($command->dailySchedules()))
            $Schedule = Schedule::fromPrimitives($command->dailySchedules());

        //TODO: validate advisor (student), subject and academic period existence

        $Tutorship = Tutorship::create(
            new TutorshipId(),
            new AdvisorId($command->advisorId()),
            new SubjectId($command->subjectId()),
            new AcademicPeriodId($command->academicPeriodId()),
            $Schedule ?? null,
        );

        $this->repository->save($Tutorship);
    }
}

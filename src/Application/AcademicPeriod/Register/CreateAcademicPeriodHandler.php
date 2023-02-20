<?php

namespace ProfessorGradingApp\Application\AcademicPeriod\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;

/**
 * Class CreateAcademicPeriodHandler
 *
 * @package ProfessorGradingApp\Application\AcademicPeriod\Register
 */
final class CreateAcademicPeriodHandler
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(
        private readonly AcademicPeriodRepository $repository
    ) {
    }

    /**
     * @param CreateAcademicPeriodCommand $command
     * @return void
     */
    public function __invoke(CreateAcademicPeriodCommand $command) : void
    {
        //TODO: deactivate previous academic period

        $AcademicPeriod = AcademicPeriod::create(
            new AcademicPeriodId(),
            $command->name(),
        );

        $this->repository->save($AcademicPeriod);
    }
}

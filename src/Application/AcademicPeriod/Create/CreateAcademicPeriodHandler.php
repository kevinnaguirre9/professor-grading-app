<?php

namespace ProfessorGradingApp\Application\AcademicPeriod\Create;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;

/**
 * Class CreateAcademicPeriodHandler
 *
 * @package ProfessorGradingApp\Application\AcademicPeriod\Create
 */
final class CreateAcademicPeriodHandler
{
    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(
        private AcademicPeriodRepository $repository
    ) {
    }

    /**
     * @param CreateAcademicPeriodCommand $command
     * @return void
     */
    public function __invoke(CreateAcademicPeriodCommand $command) : void
    {
        $AcademicPeriod = AcademicPeriod::create(
            new AcademicPeriodId(),
            $command->name(),
        );

        $this->repository->save($AcademicPeriod);
    }
}

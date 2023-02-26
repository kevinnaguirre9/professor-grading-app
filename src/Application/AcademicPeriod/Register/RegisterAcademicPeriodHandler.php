<?php

namespace ProfessorGradingApp\Application\AcademicPeriod\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\AcademicPeriod\Repositories\AcademicPeriodRepository;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodDeactivator;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;

/**
 * Class RegisterAcademicPeriodHandler
 *
 * @package ProfessorGradingApp\Application\AcademicPeriod\Register
 */
final class RegisterAcademicPeriodHandler
{
    /**
     * @var ActiveAcademicPeriodDeactivator
     */
    private ActiveAcademicPeriodDeactivator $activeAcademicPeriodDeactivator;

    /**
     * @param AcademicPeriodRepository $repository
     */
    public function __construct(
        private readonly AcademicPeriodRepository $repository
    ) {
        $this->activeAcademicPeriodDeactivator = new ActiveAcademicPeriodDeactivator($this->repository);
    }

    /**
     * @param RegisterAcademicPeriodCommand $command
     * @return void
     * @throws EmptyReportFilters
     */
    public function __invoke(RegisterAcademicPeriodCommand $command): void
    {
        $this->activeAcademicPeriodDeactivator->__invoke();

        $AcademicPeriod = AcademicPeriod::create(
            new AcademicPeriodId(),
            $command->name(),
        );

        $this->repository->save($AcademicPeriod);
    }
}

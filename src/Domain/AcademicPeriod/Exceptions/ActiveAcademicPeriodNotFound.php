<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Exceptions;

use ProfessorGradingApp\Domain\Common\Exceptions\AbstractCoreException;

/**
 * Class ActiveAcademicPeriodNotFound
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Exceptions
 */
final class ActiveAcademicPeriodNotFound extends AbstractCoreException
{
    protected const ERROR_TYPE = 'active_academic_period_not_found';

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'No active academic period found';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return 'No active academic period found';
    }
}

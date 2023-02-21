<?php

namespace ProfessorGradingApp\Domain\AcademicPeriod\Criteria;

use ProfessorGradingApp\Domain\AcademicPeriod\AcademicPeriod;
use ProfessorGradingApp\Domain\Common\Collection;

/**
 * Class AcademicPeriodsCollection
 *
 * @package ProfessorGradingApp\Domain\AcademicPeriod\Criteria
 */
final class AcademicPeriodsCollection extends Collection
{
    /**
     * @return string
     */
    protected function type(): string
    {
        return AcademicPeriod::class;
    }
}


<?php

namespace ProfessorGradingApp\Application\AcademicPeriod\Create;

/**
 * Class CreateAcademicPeriodCommand
 *
 * @package ProfessorGradingApp\Application\AcademicPeriod\Create
 */
final class CreateAcademicPeriodCommand
{
    /**
     * @param string $name
     */
    public function __construct(
        private string $name,
    )
    {
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}

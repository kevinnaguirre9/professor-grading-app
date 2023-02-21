<?php

namespace ProfessorGradingApp\Application\AcademicPeriod\Register;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class RegisterAcademicPeriodCommand
 *
 * @package ProfessorGradingApp\Application\AcademicPeriod\Register
 */
final class RegisterAcademicPeriodCommand implements Command
{
    /**
     * @param string $name
     */
    public function __construct(
        private readonly string $name,
    ) {
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}

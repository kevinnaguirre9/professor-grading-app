<?php

namespace ProfessorGradingApp\Application\Degree\Register;

/**
 * Class RegisterDegreeCommand
 *
 * @package ProfessorGradingApp\Application\Degree\Register
 */
final class RegisterDegreeCommand
{
    /**
     * @param string $name
     * @param array $subjectIds
     */
    public function __construct(
        private readonly string $name,
        private readonly array $subjectIds = [],
    ) {
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function subjectIds(): array
    {
        return $this->subjectIds;
    }
}

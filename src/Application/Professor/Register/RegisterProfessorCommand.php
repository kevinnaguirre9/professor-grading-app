<?php

namespace ProfessorGradingApp\Application\Professor\Register;

/**
 * Class RegisterProfessorCommand
 *
 * @package ProfessorGradingApp\Application\Professor\Register
 */
final class RegisterProfessorCommand
{
    /**
     * @param string $fullName
     * @param array $classIds
     * @param array $degreeIds
     */
    public function __construct(
        private readonly string $fullName,
        private readonly array $classIds = [],
        private readonly array $degreeIds = [],
    ) {
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return array
     */
    public function classIds(): array
    {
        return $this->classIds;
    }

    /**
     * @return array
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }
}
